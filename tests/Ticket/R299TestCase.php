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
 * Doctrine_Ticket_R299_TestCase
 *
 * @package     Doctrine
 * @author      Will Ferrer
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @category    Object Relational Mapping
 * @link        www.doctrine-project.org
 * @since       1.0
 * @version     $Revision$
 */
class Doctrine_Ticket_R299_TestCase extends Doctrine_UnitTestCase 
{

    public function testSubqueryReferenceParent()
    {
        $q = new Doctrine_Query();

        $q->select("CONCAT(u.name, '_1') concat1, (SELECT CONCAT(u.name, '_2') jinx FROM User u2) as concat2, CONCAT(p.phonenumber, '_3') concat3, CONCAT(p.phonenumber, '_3') concat4")
        ->from('User u')
        ->innerJoin('u.Phonenumber p')
        ->where("u.name = 'zYne'");
        
        $users = $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

        $this->assertEqual($users[0]['concat1'], 'zYne_1');

        $this->assertEqual($users[0]['concat2'], 'zYne_2');

        $this->assertEqual($users[0]['concat3'], '123 123_3');
        
        $this->assertTrue(isset($users[0]['concat4']));
    }
}