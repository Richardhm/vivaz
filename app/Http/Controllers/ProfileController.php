<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function listar()
    {
        return view('profile.index');
    }

    public function alterarUser(Request $request)
    {
        $user_id = $request->id;
        $ativo = $request->ativo == 'true' ? 1 : 0;

        $user = User::find($user_id);
        $user->ativo = $ativo;
        $user->save();
    }



    public function listUser(Request $request)
    {
        //if($request->ajax()) {
            $users = User::select('name','id','image','email','celular','ativo')
                ->where("corretora_id",auth()->user()->corretora_id)
                ->whereNotNull('name')
                ->where('name', '!=', '')
                ->orderBy("id","desc")
                ->get();
            return response()->json($users);
        //}

    }

    public function destroyUser(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:users,id'  // Substitua "users" pelo nome correto da tabela
        ]);

        // Encontra o usuário pelo ID
        $user = User::find($request->id); // Substitua "User" pelo modelo correto, se necessário

        if ($user) {
            if ($user->image) {
                $imagePath = public_path($user->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $user->delete();

            return true;


        }

        // Retorna uma resposta de erro se o usuário não for encontrado
        return response()->json(['message' => 'Usuário não encontrado.'], 404);
    }




    public function storeUser(Request $request)
    {
        $logo = null;

        // Processa a imagem caso exista
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $location = 'users';
            $file->move($location, $filename);
            $logo = $location . '/' . $filename;
        }

        // Define os dados do corretor
        $data = [
            'name' => $request->nome,
            'email' => $request->email,
            'celular' => $request->celular,
            'cargo_id' => 2, // Ajuste conforme necessário
            'corretora_id' => \auth()->user()->corretora_id,
            'password' => bcrypt('12345678'), // senha padrão, você pode alterar conforme necessário
        ];

        // Adiciona a imagem ao array de dados caso exista
        if ($logo) {
            $data['image'] = $logo;
        }

        // Usa updateOrCreate para criar ou atualizar o corretor com base no email
        $user = User::updateOrCreate(
            ['email' => $request->email], // Critério para identificar o usuário existente
            $data
        );

        return response()->json([
            'message' => $user->wasRecentlyCreated ? 'Usuário cadastrado com sucesso!' : 'Usuário atualizado com sucesso!',
            'user' => $user
        ]);

    }







}
