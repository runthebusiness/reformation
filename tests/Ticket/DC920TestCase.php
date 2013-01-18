<?php
/*
 *  $Id$
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information, see
 * <http://www.doctrine-project.org>.
 */

/**
 * Doctrine_Ticket_DC920_TestCase
 *
 * @package     Doctrine
 * @author      Will Ferrer
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @category    Object Relational Mapping
 * @link        www.doctrine-project.org
 * @since       1.0
 * @version     $Revision$
 */
class Doctrine_Ticket_DC920_TestCase extends Doctrine_UnitTestCase 
{

    public function testBeforeBodySelect()
    {
        $q = new Doctrine_Query();
        
        $q->parseDqlQuery("SELECT DISTINCT STRAIGHT_JOIN u.name, p.id FROM User u LEFT JOIN u.Phonenumber p ON p.phonenumber = '123 123'");
		$this->assertEqual($q->getSqlQuery(), "SELECT DISTINCT STRAIGHT_JOIN e.id AS e__id, e.name AS e__name, p.id AS p__id FROM entity e LEFT JOIN phonenumber p ON (p.phonenumber = '123 123') WHERE (e.type = 0)");
        $this->assertEqual($q->getDql(), "SELECT DISTINCT STRAIGHT_JOIN u.name, p.id FROM User u LEFT JOIN u.Phonenumber p ON p.phonenumber = '123 123'");
    }

	public function testBeforeBodySelectNoneDQL() 
    {
        $q = new Doctrine_Query();
        $q->select("DISTINCT STRAIGHT_JOIN u.name, p.id");
		$q->from('User u');
		$q->leftJoin("u.Phonenumber p ON (p.phonenumber = '123 123')");
        $this->assertEqual($q->getSqlQuery(), "SELECT DISTINCT STRAIGHT_JOIN e.id AS e__id, e.name AS e__name, p.id AS p__id FROM entity e LEFT JOIN phonenumber p ON (p.phonenumber = '123 123') WHERE (e.type = 0)");
        $this->assertEqual($q->getDql(), "SELECT DISTINCT STRAIGHT_JOIN u.name, p.id FROM User u LEFT JOIN u.Phonenumber p ON (p.phonenumber = '123 123')");
	}
	
    public function testBeforeBodyDelete() 
    {
        $q = new Doctrine_Query();

        $q->parseDqlQuery('DELETE IGNORE FROM User');
        $this->assertEqual($q->getSqlQuery(), 'DELETE IGNORE FROM entity WHERE (type = 0)');
        $this->assertEqual($q->getDql(), "DELETE IGNORE FROM User");
    }
	
	public function testBeforeBodyDeleteNoneDQL() 
    {
        $q = new Doctrine_Query();
        $q->delete('IGNORE');
		$q->from('User');
        $this->assertEqual($q->getSqlQuery(), 'DELETE IGNORE FROM entity WHERE (type = 0)');
        $this->assertEqual($q->getDql(), "DELETE IGNORE FROM User");
    }
	
	public function testBeforeBodyUpdate() 
    {
        $q = new Doctrine_Query();

        $q->parseDqlQuery("UPDATE IGNORE User u SET u.name = 'someone'");
        $this->assertEqual($q->getSqlQuery(), "UPDATE IGNORE entity SET name = 'someone' WHERE (type = 0)");
        $this->assertEqual($q->getDql(), "UPDATE IGNORE User u SET u.name = 'someone'");
    }
	
	public function testBeforeBodyUpdateNonDql() 
    {
        $q = new Doctrine_Query();
        $q->update('IGNORE');
		$q->from('User u');
		$q->set('name', "'someone'");
        $this->assertEqual($q->getSqlQuery(), "UPDATE IGNORE entity SET name = 'someone' WHERE (type = 0)");
        $this->assertEqual($q->getDql(), "UPDATE IGNORE User u SET name = 'someone'");
    }

}
