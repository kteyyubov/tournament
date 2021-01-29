<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\NewParticipantDto;
use App\Dto\NewTournamentDto;
use App\Exception\TournamentNotFoundException;
use App\Service\CreateParticipantService;
use App\Service\CreateTournamentService;
use App\Service\PlayTournamentService;
use App\Service\PresentTournamentService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Exception;

final class TournamentController
{
    private PresentTournamentService $presentTournamentService;
    private PlayTournamentService $playTournamentService;
    private CreateTournamentService $createTournamentService;
    private CreateParticipantService $createParticipantService;

    public function __construct(
        PresentTournamentService $presentTournamentService,
        PlayTournamentService $playTournamentService,
        CreateTournamentService $createTournamentService,
        CreateParticipantService $createParticipantService
    ) {
        $this->presentTournamentService = $presentTournamentService;
        $this->playTournamentService = $playTournamentService;
        $this->createTournamentService = $createTournamentService;
        $this->createParticipantService = $createParticipantService;
    }

    /**
     * @Route("/tournaments", methods={"POST"})
     */
    public function createTournamentAction(Request $request): JsonResponse
    {
        $name = $request->get('name');
        if (null === $name) {
            throw new BadRequestHttpException("Name paramenter required.");
        }

        return new JsonResponse(
            $this->createTournamentService->execute(new NewTournamentDto($name)),
            Response::HTTP_CREATED
        );
    }

    /**
     * @Route("/tournaments/{tournamentId}/participants", methods={"POST"})
     */
    public function createParticipantAction(int $tournamentId, Request $request): JsonResponse
    {
        $name = $request->get('name');
        $division = $request->get('division');
        if (null === $name || null === $division) {
            throw new BadRequestHttpException("Name paramenter required.");
        }

        try {
            $participant = $this->createParticipantService->execute(
                new NewParticipantDto($tournamentId, $name, $division)
            );
        } catch (Exception $exception) {
            throw new NotFoundHttpException($exception->getMessage());
        }

        return new JsonResponse($participant, Response::HTTP_CREATED);
    }

    /**
     * @Route("/tournaments/{tournamentId}/play", methods={"POST"})
     */
    public function playTournamentAction(int $tournamentId): JsonResponse
    {
        try {
            $this->playTournamentService->execute($tournamentId);
        } catch (TournamentNotFoundException $exception) {
            throw new NotFoundHttpException($exception->getMessage());
        } catch (Exception $exception) {
            throw new BadRequestHttpException($exception->getMessage());
        }

        return new JsonResponse('', Response::HTTP_CREATED);
    }

    /**
     * @Route("/tournaments/{tournamentId}", methods={"GET"})
     */
    public function getTournamentAction(int $tournamentId): JsonResponse
    {
        return new JsonResponse($this->presentTournamentService->getGames($tournamentId));
    }


}