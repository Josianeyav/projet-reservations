<?php

namespace App\Http\Controllers;

use App\Locality;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('user.edit', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'login' => 'required|string|max:255|unique:users',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required_with:confirmPassword',
                'string',
                'min:6',
                function ($attribute, $pass, $fail) {

                    if (!preg_match("/[A-Z]/", $pass)) {
                        return $fail('Le champ ' . $attribute . ' doit contenir une majuscule.');
                    }

                    if (!preg_match("/\W/", $pass)) {
                        return $fail('Le champ ' . $attribute . ' doit contenir un charactère spécial.');
                    }
                }],
            'passwordConfirm' => 'required_with:password|same:password',
            'langue' => 'required|string|max:2',
        ]);


        if ($request->filled('password') && $request->filled('confirmPassword')) {
            $fielsToTupdate = $request->all();
        } else {
            $fielsToTupdate = $request->except(['password', 'confirmPassword']);
        }

        $user = User::findOrFail($id);
        $user->update($fielsToTupdate);

        if ($this->wantsJson($request)) {
            return $this->jsonSuccess();
        } else {
            return redirect()->route('user.edit')->with('status', 'Profile mis à jour!');
        }
    }
}
