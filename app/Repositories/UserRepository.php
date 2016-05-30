<?php

namespace App\Repositories;

use App\Models\Code;
use App\Models\DoctorNurse;
use App\Models\NurseInstitutions;
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
        $user->confirmed = 0;
        $user->person_type = Code::PATIENT()->id;
        $user->save();

        return $user;
    }

    /**
     * Add a nurse-doctor pair to the database (elevate nurse).
     *
     * @param array $data
     * @return User
     */
    public function elevateNurse($user, $nurse_id)
    {
        //TODO
        $docID = $user->id;
        $docNurEntry = DoctorNurse::create(['nurse' => $nurse_id, 'doctor' => $docID]);

        return $docNurEntry;
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
     * Create a nurse and persist her to storage.
     *
     * @param array $data
     * @return User
     */
    public function createNurse(array $data)
    {
        // create the user object
        $user = new User($data);
        $user->person_type = Code::NURSE()->id;
        $user->confirmation_code = str_random(30);
        $user->save();
        // then we need to insert a record into doctors table that references the user
        $user->doctorProfile()->create($data + [
                'doctor_type_id' => Code::PERSONAL_DOCTOR()->id
        ]);
        
        return $user;
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
        $user->confirmation_code = str_random(30);
        $user->save();
        // then we need to insert a record into doctors table that references the user
        $user->doctorProfile()->create($data + [
                'doctor_type_id' => $dentist ? Code::PERSONAL_DENTIST()->id :
                    Code::PERSONAL_DOCTOR()->id
            ]);

        return $user;
    }
}