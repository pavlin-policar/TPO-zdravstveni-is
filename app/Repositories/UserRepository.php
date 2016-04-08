<?php

namespace App\Repositories;

use App\Models\Code;
use App\Models\DoctorProfile;
use App\Models\User;

/**
 * Class UserRepository
 *
 * Perform complex operations with various users.
 *
 * @package App\Repositories
 */
class UserRepository
{
    /**
     * Add a patient to the database.
     *
     * @param array $data
     * @return User
     */
    public function createPatient(array $data)
    {
        $user = new User($data);
        $user->person_type = Code::PATIENT()->id;
        $user->save();

        return $user;
    }

    /**
     * Add a doctor to the database.
     *
     * @param array $data
     * @return User
     */
    public function createDoctor(array $data)
    {
        // create the user object
        $user = new User($data);
        $user->person_type = Code::DOCTOR()->id;
        $user->save();
        // then we need to insert a record into doctors table that references the user
        $profile = new DoctorProfile;
        $user->doctorProfile()->save($profile);

        return $user;
    }
}