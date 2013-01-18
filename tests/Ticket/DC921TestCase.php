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
 * Doctrine_Ticket_DC921_TestCase
 *
 * @package     Doctrine
 * @author      Will Ferrer
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @category    Object Relational Mapping
 * @link        www.doctrine-project.org
 * @since       1.0
 * @version     $Revision$
 */
class Doctrine_Ticket_DC921_TestCase extends Doctrine_UnitTestCase 
{
  
    public function testAggregateValueMappingSupportsLeftJoinsWithRollUp()
    {
        $q = new Doctrine_Query();

        $q->select('MAX(u.name), u.*, p.*')->from('User u')->leftJoin('u.Phonenumber p')->groupby('u.id');
        $q->withRollUp();
        $this->assertEqual($q->getSqlQuery(), 'SELECT e.id AS e__id, e.name AS e__name, e.loginname AS e__loginname, e.password AS e__password, e.type AS e__type, e.created AS e__created, e.updated AS e__updated, e.email_id AS e__email_id, p.id AS p__id, p.phonenumber AS p__phonenumber, p.entity_id AS p__entity_id, MAX(e.name) AS e__0 FROM entity e LEFT JOIN phonenumber p ON e.id = p.entity_id WHERE (e.type = 0) GROUP BY e.id WITH ROLLUP');
        $this->assertEqual($q->getDql(), 'SELECT MAX(u.name), u.*, p.* FROM User u LEFT JOIN u.Phonenumber p GROUP BY u.id WITH ROLLUP');
    }
	
	public function testAggregateValueMappingSupportsLeftJoinsWithRollUpDql()
    {
        $q = new Doctrine_Query();
        $q->parseDqlQuery("SELECT MAX(u.name), u.*, p.* FROM User u LEFT JOIN u.Phonenumber p GROUP BY u.id WITH ROLLUP");
        $this->assertEqual($q->getSqlQuery(), 'SELECT e.id AS e__id, e.name AS e__name, e.loginname AS e__loginname, e.password AS e__password, e.type AS e__type, e.created AS e__created, e.updated AS e__updated, e.email_id AS e__email_id, p.id AS p__id, p.phonenumber AS p__phonenumber, p.entity_id AS p__entity_id, MAX(e.name) AS e__0 FROM entity e LEFT JOIN phonenumber p ON e.id = p.entity_id WHERE (e.type = 0) GROUP BY e.id WITH ROLLUP');
        $this->assertEqual($q->getDql(), 'SELECT MAX(u.name), u.*, p.* FROM User u LEFT JOIN u.Phonenumber p GROUP BY u.id WITH ROLLUP');
    }
	
	


}