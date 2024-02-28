<?php

namespace App\Http\Controllers\api_frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

    /**
     * @OA\Post(
     *     path="/api/v1/register",
     *     summary="Inscription du client",
     *     tags={"Register"},
     *     @OA\Response(response=200, description="Successful operation"),
     * 
     * 
     * @OA\Schema(
     * schema="UserSchema",
     *      @OA\Property(
     *            property="id",
     *            description="User identifier",
     *            type="integer",
     *            nullable="false",
     *            example="1"
     *        ),
     *  @OA\Property(
     *            property="name",
     *            description="User fullName",
     *            type="string",
     *            nullable="false",
     *            example="Alex",
     * required="true"
     *        ),
     * 
     * @OA\Property(
     *            property="phone",
     *            description="User phone",
     *            type="string",
     *            nullable="false",
     *            example="+2250000000",
     * required="true"
     *        ),
     * 
     * @OA\Property(
     *            property="email",
     *            description="User email",
     *            type="string",
     *            nullable="false",
     *            example="Alex@gmail.com",
     *             required="true"
     *        ),
     * 
     * @OA\Property(
     *            property="password",
     *            description="User Password",
     *            type="string",
     *            nullable="false",
     *            example="*****dav****",
     * required="true"
     *        )
     *    )
     * )
     * 
     */

    public function register(Request $request)
    {
        //on verifie si le client existe
        $user_verify = User::wherePhone($request['phone'])->get();
        if ($user_verify->count() > 0) {
            return response()->json([
                // 'status' => true,
                'message' => "Le numero de telephone existe déjà",
                "description" => 'On verifie si le client existe, on renvoie un message',

            ], 200);
        } else {
            $request->validate([
                'name' => 'required',
                'phone' => 'required|unique:users',
                'email' => 'required|unique:users',
                'password' => 'required',
            ]);

            $user = User::firstOrCreate([
                'name' => $request['name'],
                'phone' => $request['phone'],
                'email' => $request->email,
                'role' => 'client',
                'password' => Hash::make($request['password']),
            ]);

            // if ($request->role) {
            $user->assignRole('client');
            // }

            //create-token
            $token = $user->createToken('auth_token')->plainTextToken;

            //on retourne les infos du user inseré
            $user = User::with(['roles', 'orders'])->whereId($user['id'])->first();

            return response()->json([
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'message' => 'Inscription réussi',
            ], 200);
        }
    }



    /**
     * @OA\Post(
     *     path="/api/v1/login",
     *     summary="Connexion du client",
     *     tags={"Login"},
     *     @OA\Response(response=200, description="Successful operation"),
     * 
     * 
     * @OA\Schema(
     * schema="UserSchema",
     * 
     * @OA\Property(
     *            property="phone",
     *            description="User phone",
     *            type="string",
     *            nullable="false",
     *            example="+2250000000",
     * required="true"
     *        ),
     * 
     * 
     * @OA\Property(
     *            property="password",
     *            description="User Password",
     *            type="string",
     *            nullable="false",
     *            example="*****dav****",
     * required="true"
     *        )
     *    )
     * )
     * 
     */


    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        //verify data in

        $data = $request->only('phone', 'password');
        $auth = Auth::attempt($data);

        // $fieldType = filter_var($request->phone, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        // $auth = Auth::attempt((array($fieldType => $request['phone'], 'password' => $request['password'])));

        if (!$auth) {
            return response()->json([
                'message' => 'Contact ou mot de passe incorrect'
            ], 401);
        } else {
            $user = User::with(['roles', 'orders'])->wherePhone($request['phone'])->first();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'message' => 'Connexion réussi',
            ], 200);
        }
    }


    /**
     * @OA\Get(
     *     path="/api/v1/userAuth",
     *     summary="Utilisateur connecté",
     *     tags={"User Auth "},
     *     @OA\Response(response=200, description="Successful operation"),
     * )
     * 
     */
    public function user_auth(Request $request)
    {

        try {
            $user = Auth::user();
            return response()->json([
                'message' => 'Operation réussi',
                'user' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Veuillez vous connecter',
            ], 200);
        }
    }


    /**
     * @OA\Post(
     *     path="/api/v1/updateProfil",
     *     summary="Utilisateur connecté",
     *     tags={"User upadate profil "},
     *     @OA\Response(response=200, description="Successful operation"),
     * )
     * 
     */

    public function update_profil(Request $request)
    {

        if ($request->has('old_password')) {
            //verification de l'ancien mot de passe
            if (!Hash::check($request->old_password, auth()->user()->password)) {
                return response()->json(['error' => 'Ancien Mot de passe incorrect'], 401);
            } else {
                $request->validate([
                    'name' => 'required',
                    'phone' => 'required',
                    'email' => 'required',
                    'old_password' => 'required',
                    'new_password' => 'required',
                ]);
                $user = tap(User::whereId(Auth::user()->id))->update([
                    'name' => $request['name'],
                    'phone' => $request['phone'],
                    'email' => $request['email'],
                    // 'shop_name' => $request['shop_name'],
                    // 'localisation' => $request['localisation'],
                    'password' => Hash::make($request['new_password']),
                ]);

                $user = User::whereId(Auth::user()->id)->first();

                return response()->json([
                    'message' => 'Compte modifié avec success',
                    'user' => $user
                ], 200);
            }
        } else {

            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',

            ]);
            $user = tap(User::whereId(Auth::user()->id))->update([
                'name' => $request['name'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                // 'shop_name' => $request['shop_name'],
                // 'localisation' => $request['localisation'],
                // 'password' => Hash::make($request['new_password']),
            ]);
            $user = User::whereId(Auth::user()->id)->first();

            return response()->json([
                'message' => 'Compte modifié avec success',
                'user' => $user
            ], 200);
        }
    }





    /**
     * @OA\Get(
     *     path="/api/v1/logout",
     *     summary="Deconnexion du user",
     *     tags={"Logout "},
     *     @OA\Response(response=200, description="Successful operation"),
     * )
     * 
     */

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Operation réussi',
        ], 200);
    }
}
