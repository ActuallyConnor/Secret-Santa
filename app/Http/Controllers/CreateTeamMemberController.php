<?php

namespace App\Http\Controllers;

use App\Api\Serializers\TeamMembers\TeamMemberSerializer;
use App\Models\TeamMembersModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateTeamMemberController extends Controller
{
    public function __construct(
        private readonly TeamMemberSerializer $serializer,
        private readonly TeamMembersModel $model
    ) {

    }

    public function __invoke(Request $request) : JsonResponse
    {
        // TODO: validate

        $teamMember = $this->serializer->deserialize(json_decode($request->getContent(), true));

        $this->model->createTeamMember($teamMember);

        return new JsonResponse(
            $this->serializer->serialize($this->model->findByUuid($teamMember->getUuid())),
            201
        );
    }
}
