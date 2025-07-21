<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\OutcomeResource;
use App\Models\User;
use App\Repositories\OutcomeRepository;
use App\Services\OutcomeService;
use Inertia\Inertia;
use Inertia\Response;

class OutcomeController extends Controller
{
    public function __construct(
        private readonly OutcomeService $outcomeService,
        private readonly OutcomeRepository $outcomeRepository,
    ) {
        //
    }

    public function index(User $user): Response
    {
        $outcomes = $this->outcomeRepository->receiveByUser($user);

        return Inertia::render('History', [
            'user' => $user->token,
            'outcomes' => OutcomeResource::collection($outcomes),
        ]);
    }

    public function store(User $user): OutcomeResource
    {
        $outcomes = $this->outcomeService->play($user);

        return OutcomeResource::make($outcomes);
    }
}
