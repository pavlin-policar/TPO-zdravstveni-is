<?php

use App\Models\Code;
use App\Models\Postcode;
use App\Models\User;
use App\Repositories\GenderRepository;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\MinkContext;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Laracasts\Behat\Context\Services\MailTrap;
use PHPUnit_Framework_Assert as PHPUnit;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{
    use MailTrap;

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
     * Create a new user that still has to validate their email and create their profile.
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
     * Create a user that has already validated their email but still has to create their profile.
     *
     * @Given /^I have a validated user with\s*(?:the email "([^"]+)")?$/
     */
    public function createValidatedUser($email)
    {
        $user = new User([
            'email' => $email,
            'password' => bcrypt('password'),
        ]);
        $user->confirmEmail();
        $user->save();
    }

    /**
     * Create a fully registered user, profile and all.
     *
     * @Given /^I have an existing user with\s*(?:the email "([^"]+)")?$/
     */
    public function createRegisteredUser($email)
    {
        $user = new User([
            'first_name' => 'Janez',
            'last_name' => 'Novak',
            'birth_date' => Carbon::create(1994, 1, 1),
            'gender' => app(GenderRepository::class)->getMale()->id,
            'email' => $email,
            'password' => bcrypt('password'),
            'phone_number' => '+386 40 123 123 123',
            'post' => 1,
            'address' => 'Address',
            'zz_card_number' => 'Totally valid',
        ]);
        $user->confirmEmail();
        $user->save();
    }

    /**
     * Create a fully registered user, profile and all.
     *
     * @Given /^I have have registered as Janez Novak$/
     */
    public function createJanezNovak()
    {
        $user = new User([
            'first_name' => 'Janez',
            'last_name' => 'Novak',
            'birth_date' => Carbon::create(2000, 1, 1, 0, 0, 0),
            'gender' => app(GenderRepository::class)->getMale()->id,
            'email' => 'janez.novak@gmail.com',
            'password' => bcrypt('password'),
            'phone_number' => '123456789',
            'post' => Postcode::wherePostcode(1000)->first()->id,
            'address' => 'Dunajska',
            'zz_card_number' => '123',
        ]);
        $user->confirmEmail();
        $user->save();
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
            'password' => 'password',
        ]);
    }

    /**
     * Helper function that creates a full user and logs in as that user.
     *
     * @Given /^I am logged in$/
     */
    public function loggedIn()
    {
        $user = new User([
            'first_name' => 'Janez',
            'last_name' => 'Novak',
            'birth_date' => Carbon::create(2000, 1, 1, 0, 0, 0),
            'gender' => Code::MALE()->id,
            'email' => 'janez.novak@gmail.com',
            'password' => bcrypt('password'),
            'phone_number' => '123456789',
            'post' => Postcode::wherePostcode(1000)->first()->id,
            'address' => 'Dunajska',
            'zz_card_number' => '123',
        ]);
        $user->confirmEmail();
        $user->save();

        Auth::attempt([
            'email' => $user->email,
            'password' => 'password',
        ]);
    }

    /**
     * Make the authenticated user be the caretaker of a new user with name.
     *
     * @Given /^I am taking care of "([^"]+)"$/
     */
    public function iAmTakingCareOf($name)
    {
        $user = new User([
            'first_name' => $name,
            'last_name' => 'Novak',
            'birth_date' => Carbon::create(2000, 1, 1, 0, 0, 0),
            'gender' => Code::MALE()->id,
            'email' => $name . '.novak@gmail.com',
            'password' => bcrypt('password'),
            'phone_number' => '123456789',
            'post' => Postcode::wherePostcode(1000)->first()->id,
            'address' => 'Dunajska',
            'zz_card_number' => str_random(50),
            'caretaker' => Auth::user()->id,
        ]);
        $user->confirmEmail();
        $user->save();
    }

    /**
     * Checks, that current page PATH is NOT equal to specified
     *
     * @Then /^(?:|I )should not be on "(?P<page>[^"]+)"$/
     */
    public function pageAddressNot($page)
    {
        $this->assertSession()->addressNotEquals($this->locatePath($page));
    }

    /**
     * Check that an email has been sent to the given email with subject and body containing.
     *
     * @Then /^An email should be sent to "([^"]+)" with subject "([^"]+)" containing "([^"]+)"$/
     */
    public function emailShouldBeSentToWithSubjectAndBody($email, $subject, $contains)
    {
        $inbox = $this->fetchInbox();
        PHPUnit::assertCount(1, $inbox);

        $message = $inbox[0];
        PHPUnit::assertEquals($email, $message['to_email']);
        PHPUnit::assertContains($subject, $message['subject']);
        PHPUnit::assertContains($contains, $message['html_body']);

        // clear the inbox after we're done.
        $this->emptyInbox();
    }

    /**
     * Check that an email has been sent to the given email.
     *
     * @Then /^An email should be sent to "([^"]+)" with their confirmation code$/
     */
    public function emailShouldBeSentToWithConfirmationCode($email)
    {
        $inbox = $this->fetchInbox();
        PHPUnit::assertCount(1, $inbox);

        $message = $inbox[0];
        PHPUnit::assertEquals($email, $message['to_email']);

        $user = User::whereEmail($email)->firstOrFail();
        PHPUnit::assertContains($user->getConfirmationCode(), $message['html_body']);

        // clear the inbox after we're done.
        $this->emptyInbox();
    }

    /**
     * Check that an email has been sent to the given email.
     *
     * @Then /^An email should be sent to "([^"]+)" with subject "([^"]+)"$/
     */
    public function emailShouldBeSentToWithSubject($email, $subject)
    {
        $inbox = $this->fetchInbox();
        PHPUnit::assertCount(1, $inbox);

        $message = $inbox[0];
        PHPUnit::assertEquals($email, $message['to_email']);
        PHPUnit::assertContains($subject, $message['subject']);

        // clear the inbox after we're done.
        $this->emptyInbox();
    }

    /**
     * Check that an email has been sent to the given email.
     *
     * @Then /^An email should be sent to "([^"]+)" containing "([^"]+)"$/
     */
    public function emailShouldBeSentToWithBody($email, $contains)
    {
        $inbox = $this->fetchInbox();
        PHPUnit::assertCount(1, $inbox);

        $message = $inbox[0];
        PHPUnit::assertEquals($email, $message['to_email']);
        PHPUnit::assertContains($contains, $message['html_body']);

        // clear the inbox after we're done.
        $this->emptyInbox();
    }
}
