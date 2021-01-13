<?php

namespace App\Http\Controllers;

use App\Interfaces\UserInterface;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * @var
     */
    private $user;

    /**
     * Create a new controller instance.
     *
     * @param UserInterface $user
     */
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Get the current logged in user
     *
     * @return JsonResponse
     */
    public function me()
    {
        return response()->json($this->user->me(auth()->user()->id), 200);
    }

    /**
     * Get all users
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json($this->user->all(), 200);
    }

    /**
     * Get my sessions
     *
     * @return JsonResponse
     */
    public function sessions()
    {
        return response()->json($this->user->sessions(auth()->user()->id), 200);
    }
}
