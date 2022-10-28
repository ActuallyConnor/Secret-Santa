<?php

namespace App\Http\Controllers;

use App\Api\Serializers\Teams\TeamSerializer;
use App\Models\TeamsModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateTeamController extends Controller
{
    public function __construct(
        private readonly TeamSerializer $serializer,
        private readonly TeamsModel $model
    ) {

    }

    public function __invoke(Request $request) : JsonResponse
    {
        // TODO: validate

        $team = $this->serializer->deserialize(json_decode($request->getContent(), true));

        $this->model->createTeam($team);

        return new JsonResponse(
            $this->serializer->serialize($this->model->findByUuid($team->getUuid())),
            201
        );
    }
}
