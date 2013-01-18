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
 * Doctrine_Ticket_1488_TestCase
 *
 * @package     Doctrine
 * @author      Will Ferrer
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @category    Object Relational Mapping
 * @link        www.doctrine-project.org
 * @since       1.0
 * @version     $Revision$
 */
class Doctrine_Ticket_DC910_TestCase extends Doctrine_UnitTestCase
{
    public function test2SubqueriesInJoin()
    {
        $q = Doctrine_Query::create()
            ->from('T1488_Class1 c1')
            ->leftJoin('c1.Classes2 c2 WITH c2.value BETWEEN (SELECT c3.min FROM T1488_Class1 c3) AND (SELECT c4.max FROM T1488_Class1 c4)');
        $this->assertEqual($q->getSqlQuery(), 'SELECT t.id AS t__id, t.min AS t__min, t.max AS t__max, t2.id AS t2__id, t2.value AS t2__value FROM t1488__class1 t LEFT JOIN t1488__relation t3 ON (t.id = t3.c1_id) LEFT JOIN t1488__class2 t2 ON t2.id = t3.c2_id AND (t2.value BETWEEN (SELECT t4.min AS t4__min FROM t1488__class1 t4) AND (SELECT t5.max AS t5__max FROM t1488__class1 t5))');
    }
	
	public function test2SQLSubqueriesInJoin()
    {
        $q = Doctrine_Query::create()
            ->from('T1488_Class1 c1')
            ->leftJoin('c1.Classes2 c2 WITH c2.value BETWEEN (SQL:SELECT t4.min AS t4__min FROM t1488__class1 t4) AND (SQL:SELECT t5.max AS t5__max FROM t1488__class1 t5)');
        $this->assertEqual($q->getSqlQuery(), 'SELECT t.id AS t__id, t.min AS t__min, t.max AS t__max, t2.id AS t2__id, t2.value AS t2__value FROM t1488__class1 t LEFT JOIN t1488__relation t3 ON (t.id = t3.c1_id) LEFT JOIN t1488__class2 t2 ON t2.id = t3.c2_id AND (t2.value BETWEEN (SELECT t4.min AS t4__min FROM t1488__class1 t4) AND (SELECT t5.max AS t5__max FROM t1488__class1 t5))');
    }
	
	public function testNotInJoin()
    {
        $q = Doctrine_Query::create()
            ->from('T1488_Class1 c1')
            ->leftJoin('c1.Classes2 c2 WITH c2.value NOT IN (1, 2, 3)');
        $this->assertEqual($q->getSqlQuery(), 'SELECT t.id AS t__id, t.min AS t__min, t.max AS t__max, t2.id AS t2__id, t2.value AS t2__value FROM t1488__class1 t LEFT JOIN t1488__relation t3 ON (t.id = t3.c1_id) LEFT JOIN t1488__class2 t2 ON t2.id = t3.c2_id AND (t2.value NOT IN (1, 2, 3))');
    }
}
