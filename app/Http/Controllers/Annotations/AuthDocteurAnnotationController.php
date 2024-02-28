<?php

namespace App\Http\Controllers\Annotations ;

/**
 * @OA\Security(
 *     security={
 *         "BearerAuth": {}
 *     }),

 * @OA\SecurityScheme(
 *     securityScheme="BearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"),

 * @OA\Info(
 *     title="Sama_Docteur",
 *     description="SamaDocteur est une plateforme de gestion des prises de rendez-vous et de la recherche des docteurs en fonction de leur specialites et des hopitaux en fontion de leur localite",
 *     version="1.0.0"),

 * @OA\Consumes({
 *     "multipart/form-data"
 * }),

 *

 * @OA\POST(
 *     path="/api/login",
 *     summary="Login",
 *     description="",
 *         security={
 *    {       "BearerAuth": {}}
 *         },
 * @OA\Response(response="201", description="Created successfully"),
 * @OA\Response(response="400", description="Bad Request"),
 * @OA\Response(response="401", description="Unauthorized"),
 * @OA\Response(response="403", description="Forbidden"),
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="email", type="string"),
 *                     @OA\Property(property="password", type="string"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"AuthDocteur"},
*),


 * @OA\POST(
 *     path="/api/registerdocteur",
 *     summary="RegisterDocteur",
 *     description="",
 *         security={
 *    {       "BearerAuth": {}}
 *         },
 * @OA\Response(response="201", description="Created successfully"),
 * @OA\Response(response="400", description="Bad Request"),
 * @OA\Response(response="401", description="Unauthorized"),
 * @OA\Response(response="403", description="Forbidden"),
 *     @OA\Parameter(in="path", name="", required=false, @OA\Schema(type="string")
 * ),
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="nom", type="string"),
 *                     @OA\Property(property="prenom", type="string"),
 *                     @OA\Property(property="sexe", type="string"),
 *                     @OA\Property(property="age", type="string"),
 *                     @OA\Property(property="telephone", type="string"),
 *                     @OA\Property(property="email", type="string"),
 *                     @OA\Property(property="adresse", type="string"),
 *                     @OA\Property(property="photo_profil", type="string", format="binary"),
 *                     @OA\Property(property="password", type="string"),
 *                     @OA\Property(property="annee_experience", type="string"),
 *                     @OA\Property(property="specialite_id", type="string"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"AuthDocteur"},
*),


 * @OA\POST(
 *     path="/api/logoutDocteur",
 *     summary="LogoutDocteur",
 *     description="",
 *         security={
 *    {       "BearerAuth": {}}
 *         },
 * @OA\Response(response="201", description="Created successfully"),
 * @OA\Response(response="400", description="Bad Request"),
 * @OA\Response(response="401", description="Unauthorized"),
 * @OA\Response(response="403", description="Forbidden"),
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * ),
 *     tags={"AuthDocteur"},
*),


*/

 class AuthDocteurAnnotationController {}
