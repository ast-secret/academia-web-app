<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MachinesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MachinesTable Test Case
 */
class MachinesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Machines' => 'app.machines',
        'Gyms' => 'app.gyms',
        'Phones' => 'app.phones',
        'Rooms' => 'app.rooms',
        'Lessons' => 'app.lessons',
        'Services' => 'app.services',
        'Weekdays' => 'app.weekdays',
        'ServicesWeekdays' => 'app.services_weekdays',
        'Users' => 'app.users',
        'Roles' => 'app.roles',
        'Cards' => 'app.cards',
        'Customers' => 'app.customers',
        'Suggestions' => 'app.suggestions',
<<<<<<< HEAD
        'ExercisesGroups' => 'app.exercises_groups',
        'Exercises' => 'app.exercises',
=======
        'Exercises' => 'app.exercises',
        'CardsExercises' => 'app.cards_exercises',
        'ExercisesGroups' => 'app.exercises_groups',
>>>>>>> db391e975ea2e6de5e5488bb493dc5474a6ca65a
        'Releases' => 'app.releases'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Machines') ? [] : ['className' => 'App\Model\Table\MachinesTable'];
        $this->Machines = TableRegistry::get('Machines', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Machines);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
