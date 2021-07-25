<?php


namespace Tests\controllers;


use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Http\Response;


class IncidentManagementTest extends TestCase
{
    use DatabaseTransactions;

    public function testGetIncidentsReturnsDataInValidFormat()
    {

        $this->json('get', 'api/incidents')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'latitude',
                            'longitude',
                            'title',
                            'category',
                            'people',
                            'comments',
                            'incidentDate',
                            'createDate',
                            'modifyDate',
                        ]
                    ]
                ]
            );
    }

    public function testInsertIncidentIsCreatedSuccessfully()
    {

        $payload = '{"data":[{"id":0,"location":{"latitude":12.9231501,"longitude":-174.7818517},"title":"incident title","category":1,"people":[{"name":"Name of person","type":"staff"},{"name":"Name of person","type":"witness"},{"name":"Name of person","type":"staff"}],"comments":"This is a string of comments","incidentDate":"2020-09-01T23:26:00+00:00","createDate":"2020-09-01T13:32:59+01:00","modifyDate":"2020-09-01T13:32:59+01:00"}]}';


        $this->json('post', 'api/incidents', json_decode($payload, true))
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'status',
                    'message'
                ]
            );
    }

    public function testErrorCatchingInInsertIncidentIsCreatedSuccessfully()
    {

        $payload = '{"data":[{"id":0,"location":{"latitude":12.9231501,"longitude":-174.7818517},"title":"incident title","category":4,"people":[{"name":"Name of person","type":"staff"},{"name":"Name of person","type":"witness"},{"name":"Name of person","type":"staff"}],"comments":"This is a string of comments","incidentDate":"2020-09-01T23:26:00+00:00","createDate":"2020-09-01T13:32:59+01:00","modifyDate":"2020-09-01T13:32:59+01:00"}]}';


        $this->json('post', 'api/incidents', json_decode($payload, true))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure(
                [
                    "errors"
                ]
            );
    }
}
