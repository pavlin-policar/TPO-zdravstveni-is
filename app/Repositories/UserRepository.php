<?php

namespace App\Repositories;

use App\Models\Code;
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
     * Just update the user, handles the different user types automatically so you don't have to
     * worry about shitty business logic.
     *
     * @param User $user
     * @param array $data
     * @return User
     */
    public function updateUser(User $user, array $data)
    {
        if ($user->isDoctor()) {
            return $this->updateDoctor($user, $data);
        } else {
            return $this->updatePatient($user, $data);
        }
    }

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
     * Update a given patient and persist changes to storage.
     *
     * @param User $user
     * @param array $data
     * @return User
     */
    public function updatePatient(User $user, array $data)
    {
        // ignore malicious attempt to set personal doctor to one who isn't accepting any more ppl
        if (array_key_exists('personal_doctor_id', $data)) {
            if (!User::find($data['personal_doctor_id'])->acceptingPatients()) {
                unset($data['personal_doctor_id']);
            }
        }
        // ignore malicious attempt to set personal dentist to one who isn't accepting any more ppl
        if (array_key_exists('personal_dentist_id', $data)) {
            if (!User::find($data['personal_dentist_id'])->acceptingPatients()) {
                unset($data['personal_dentist_id']);
            }
        }
        $user->update($data);
        return $user;
    }

    /**
     * Create a dentist and persist them to storage.
     *
     * @param array $data
     * @return User
     */
    public function createPersonalDentist(array $data)
    {
        return $this->createDoctor($data, true);
    }

    /**
     * Create a dentist and persist them to storage.
     *
     * @param array $data
     * @return User
     */
    public function createPersonalDoctor(array $data)
    {
        return $this->createDoctor($data, false);
    }

    /**
     * Update a given doctor and persist changes to storage.
     *
     * @param User $user
     * @param array $data
     * @return User
     */
    public function updateDoctor(User $user, array $data)
    {
        $user->update($data);
        $user->doctorProfile->update($data);
        return $user;
    }

    /**
     * Add a doctor to the database.
     *
     * @param array $data
     * @param bool $dentist
     * @return User
     */
    protected function createDoctor(array $data, $dentist = false)
    {
        // create the user object
        $user = new User($data);
        $user->person_type = Code::DOCTOR()->id;
        /*if ($dentist) {
            $user->doctor_type_id = Code::PERSONAL_DENTIST()->id;
        } else {
            $user->doctor_type_id = Code::PERSONAL_DOCTOR()->id;
        }*/
        //^--Throws error, when saving to DB: can't find column doctor_type_id in table user
        // (which makes sense, since it's supposed to be in table doctor).
        $user->save();
        // then we need to insert a record into doctors table that references the user
        $user->doctorProfile()->create($data);

        return $user;
    }
}