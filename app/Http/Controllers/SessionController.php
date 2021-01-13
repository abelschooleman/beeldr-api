<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\SessionCreated;
use Illuminate\Http\JsonResponse;
use App\Interfaces\SessionInterface;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var
     */
    protected $event;

    /**
     * Create a new controller instance.
     *
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * Handle create new session request
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function create(Request $request)
    {
        $this->validate($request, ['name' => 'required|alpha|unique:sessions', 'invitees' => 'required']);

        $result = $this->session->create($request->all(), auth()->user()->id);

        event(new SessionCreated($result, $request->invitees));

        return response()->json($result, 201);
    }

    /**
     * Fetch all sessions
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json($this->session->all());
    }

    /**
     * Delete the session
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
        $this->session->destroy($request->id);

        return response()->json(null, 204);
    }
}
