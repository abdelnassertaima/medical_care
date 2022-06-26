<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:3',
        ]);

        if (!$validator->fails()) {
            try {
                $response = Http::asForm()->post('http://enable.mr-dev.tech/oauth/token', [
                    'grant_type' => 'password',
                    'client_id' => '3',
                    'client_secret' => 'PbHJwFlC1VMarTrWlGcqQxgskwKyLL6OJtzElS8o',
                    'username' => $request->input('email'),
                    'password' => $request->input('password'),
                    'scope' => '*',
                ]);

                // return $response;
                $user = User::where('email', '=', $request->input('email'))->first();

                $user->setAttribute('token', $response->json()['access_token']);
                $user->setAttribute('token_type', $response->json()['token_type']);
                return response()->json([
                    'status' => true,
                    'message' => Messages::getMessage('LOGGED_IN_SUCCESSFULLY'),
                    'object' => $user
                ]);
            } catch (\Throwable $th) {
                return response()->json($response->json(), Response::HTTP_UNAUTHORIZED);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function userLogin(Request $request)
    {
        $validator = Validator($request->all(), [
            'mobile' => 'required|numeric|digits:8',
            'password' => 'required|string|min:3',
        ]);

        if (!$validator->fails()) {
            try {
                $response = Http::asForm()->post('http://enable.mr-dev.tech/oauth/token', [
                    'grant_type' => 'password',
                    'client_id' => '2',
                    'client_secret' => 'TGyuuzW3E3wqOG76K4hu4ZFIoN43YMQNWGDjNdsP',
                    'username' => $request->input('mobile'),
                    'password' => $request->input('password'),
                    'scope' => '*',
                ]);
                $user = User::where('mobile', '=', $request->input('mobile'))->first();

                $user->setAttribute('token', $response->json()['access_token']);
                $user->setAttribute('token_type', $response->json()['token_type']);
                return response()->json([
                    'status' => true,
                    'message' => Messages::getMessage('LOGGED_IN_SUCCESSFULLY'),
                    'object' => $user
                ]);
            } catch (\Throwable $th) {
                return response()->json($response->json(), Response::HTTP_UNAUTHORIZED);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:45',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|numeric|unique:users,mobile|digits:8',
            'password' => 'required|string|min:3',
        ]);

        if (!$validator->fails()) {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->mobile = $request->input('mobile');
            $user->password = Hash::make($request->input('password'));
            $isSaved = $user->save();
            return response()->json([
                'message' => Messages::getMessage($isSaved ? 'REGISTERED_SUCCESSFULLY' : 'REGISTRATION_FAILED'),
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function forgetPassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if (!$validator->fails()) {
            $user = User::where('email', '=', $request->input('email'))->first();
            $authCode = random_int(1000, 9999);
            $user->auth_code = Hash::make($authCode);
            $isSaved = $user->save();
            return response()->json(
                [
                    'status' => $isSaved,
                    'message' => $isSaved ? 'Reset code sent successfully' : 'Failed to send reset code!',
                    'code' => $authCode
                ],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'username' => 'required|email|exists:users,email',
            'auth_code' => 'required|numeric|digits:4',
            'password' => 'required|string|min:3|max:15|confirmed'
        ]);

        if (!$validator->fails()) {
            $user = User::where('email', '=', $request->input('email'))->first();
            if (!is_null($user->auth_code)) {
                if (Hash::check($request->input('auth_code'), $user->auth_code)) {
                    $user->password = $request->input('password');
                    $user->auth_code = null;
                    $isSaved = $user->save();
                    return response()->json(
                        [
                            'status' => $isSaved,
                            'message' => Messages::getMessage($isSaved ? 'RESET_PASSWORD_SUCCESS' : 'RESET_PASSWORD_FAILED'),
                        ],
                        $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
                    );
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => Messages::getMessage('AUTH_CODE_ERROR')
                    ], Response::HTTP_BAD_REQUEST);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => Messages::getMessage('NO_PASSWORD_RESET_CODE')
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    private function checkActiveSessions($userId)
    {
        return DB::table('oauth_access_tokens')
            ->where('user_id', '=', $userId)
            ->where('revoked', '=', false)
            ->exists();
    }

    private function endPreviousSessions($userId)
    {
        return DB::table('oauth_access_tokens')
            ->where('user_id', '=', $userId)
            ->where('name', '=', 'User-API')
            ->update([
                'revoked' => true
            ]);
    }

    public function logout(Request $request)
    {
        $token = $request->user('user-api')->token();
        $revoked = $token->revoke();
        return response()->json([
            'status' => $revoked,
            'message' => Messages::getMessage($revoked ? 'LOGGED_OUT_SUCCESSFULLY' : 'LOGGED_OUT_FAILED'),
        ]);
    }
}
