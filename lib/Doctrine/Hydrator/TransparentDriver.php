<?php
/*
 *  $Id: Hydrate.php 3192 2007-11-19 17:55:23Z romanb $
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
 * Get results directly and skip hydration. Uses PDO::FETCH_NUM
 *
 *
 * @package     Doctrine
 * @subpackage  Hydrate
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.doctrine-project.org
 * @since       1.2
 * @version     $Revision: 3192 $
 * @author      Jonathan H. Wage <jonwage@gmail.com>
 */
class Doctrine_Hydrator_TransparentDriver extends Doctrine_Hydrator_Abstract
{
	// fixed: https://a2d.unfuddle.com/a#/projects/4/tickets/by_number/323 and public https://github.com/runthebusiness/reformation/issues/11
    public function hydrateResultSet($stmt)
    {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}