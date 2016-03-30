<?php

use App\Models\User;
use App\Repositories\GenderRepository;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\MinkContext;
use Carbon\Carbon;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{
    /**
     * Migrate the database before each scenario.
     *
     * @beforeScenario
     */
    public function migrate()
    {
        Artisan::call('migrate', [
            '--seed' => true
        ]);
    }

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * Create a new user that still has to create their profile.
     *
     * @Given /^I have a new user with\s*(?:the email "([^"]+)")?$/
     */
    public function createNewUser($email)
    {
        User::create([
            'email' => $email,
            'password' => bcrypt('password'),
        ]);
    }

    /**
     * Create a fully registered user, profile and all.
     *
     * @Given /^I have an existing user with\s*(?:the email "([^"]+)")?$/
     */
    public function createRegisteredUser($email)
    {
        User::create([
            'firstName' => 'Janez',
            'lastName' => 'Novak',
            'birthDate' => Carbon::create(1994, 1, 1),
            'gender' => app(GenderRepository::class)->getMale()->id,
            'email' => $email,
            'password' => bcrypt('password'),
            'phoneNumber' => '+386 40 123 123 123',
            'post' => 1,
            'address' => 'Address',
            'ZZCardNumber' => 'Totally valid',
            'personalDoctor' => 1,
            'personalDentist' => 1,
        ]);
    }

    /**
     * Helper function that logs in the user with the default password.
     *
     * @Given /^I log in as "([^"]+)"$/
     */
    public function iLogInAs($email)
    {
        Auth::attempt([
            'email' => $email,
            'password' => 'password'
        ]);
    }

    /**
     * Checks, that current page PATH is NOT equal to specified
     *
     * @Then /^(?:|I )should not be on "(?P<page>[^"]+)"$/
     */
    public function assertPageAddressNot($page)
    {
        $this->assertSession()->addressNotEquals($this->locatePath($page));
    }
}
