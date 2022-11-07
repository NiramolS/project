<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Hash;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\QueryException;

class UserController extends SearchableController
{
    private string $title = 'User';
    private array $roles = ['ADMIN', 'USER'];

    function getQuery(): Builder|Relation
    {
        return User::orderBy('email');
    }

    function find(string $userEmail)
    {
        return $this->getQuery()->where('email', $userEmail)->firstOrFail();
    }

    function filterByTerm(Builder|Relation $query, ?string $term): Builder|Relation
    {
        if (!empty($term)) {
            foreach (\preg_split('/\s+/', \trim($term)) as $word) {
                $query->where(function (Builder|Relation $innerQuery) use ($word) {
                    $innerQuery
                        ->where('email', 'LIKE', "%{$word}%")
                        ->orWhere('name', 'LIKE', "%{$word}%")
                        ->orWhere('role', 'LIKE', "%{$word}%");
                });
            }
        }
        return $query;
    }

    function list(Request $request)
    {
        $this->authorize('view', User::class);
        $search = $this->prepareSearch($request->getQueryParams());
        $query = $this->search($search);

        // session()->put('bookmark.user-view', $request->getUri());

        return view('users.list', [
            'title' => "{$this->title} : List",
            'search' => $search,
            'users' => $query->paginate(5),
        ]);
    }

    function show($userEmail)
    {
        $this->authorize('view', User::class);
        $user = User::where('email', $userEmail)->firstOrFail();

        return view('users.view', [
            'title' => "{$this->title} : View",
            'user' => $user,
        ]);
    }

    function updateForm($userEmail)
    {
        $this->authorize('update', User::class);
        $user = $this->find($userEmail);

        return view('users.update-form', [
            'title' => "{$this->title} : Update",
            'user' => $user,
            'roles' => $this->roles,
        ]);
    }

    function update(Request $request, $userEmail)
    {
        $this->authorize('update', User::class);

        try {

            $user = $this->find($userEmail);
            $data = $request->getParsedBody();
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }
            $user->fill($data);
            $user->role = $data['role'];
            $user->save();

            return redirect()->route('user-view', [
                'user' => $user->email,
            ])->with('status', "$user->email was updated.");
        } catch (QueryException $excp) {
            return redirect()->back()->withInput()->withErrors([
                'error' => $excp->errorInfo[2],
            ]);
        }
    }

    function delete($userEmail)
    {
        $this->authorize('delete', User::class);

        try {
            $user = $this->find($userEmail);
            $user->delete();

            return redirect(session()->get('bookmark.user-view', route('user-list')))
                ->with('status', "$user->email was deleted.");
        } catch (QueryException $excp) {
            return redirect()->back()->withInput()->withErrors([
                'error' => $excp->errorInfo[2],
            ]);
        }
    }

    function createForm()
    {
        $this->authorize('create', User::class);

        return view('users.create-form', [
            'title' => "{$this->title} : Create",
            'roles' => $this->roles
        ]);
    }

    function create(Request $request)
    {
        $this->authorize('create', User::class);

        try {
            $user = new User();
            $data = $request->getParsedBody();
            $data['password'] = Hash::make($data['password']);
            $user->fill($data);
            $user->role = 'USER';
            $user->email_verified_at = new \DateTimeImmutable();
            $user->save();

            return redirect()->route('user-list')
                ->with('status', "$user->email was created.");
        } catch (QueryException $excp) {
            return redirect()->back()->withInput()->withErrors([
                'error' => $excp->errorInfo[2],
            ]);
        }
    }
}
