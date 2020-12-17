<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common
 * Created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file
 * LICENSE which is distributed with this source code.
 * Para a informação dos direitos autorais e de licença você deve ler o arquivo
 * LICENSE que é distribuído com este código-fonte.
 * Para obtener la información de los derechos de autor y la licencia debe leer
 * el archivo LICENSE que se distribuye con el código fuente.
 * For more information, see <https://opensource.gpupo.com/>.
 *
 */

namespace Gpupo\Common\Tools\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

trait DoctrineManagerAwareTrait
{
    protected $_doctrine_services = [
        'EntityManagerInterface' => false,
        'DocumentManager' => false,
    ];

    protected function _doctrine_service_set($key, $value): void
    {
        if (null !== $value) {
            $this->_doctrine_services[$key] = $value;
        }
    }

    protected function _doctrine_service_get($key)
    {
        return $this->_doctrine_services[$key];
    }

    protected function setDoctrine(EntityManagerInterface $doctrine = null, ObjectManager $documentManager = null): void
    {
        $this->_doctrine_service_set('EntityManagerInterface', $doctrine);
        $this->_doctrine_service_set('DocumentManager', $documentManager);
    }

    protected function getDoctrineEntityManager(): EntityManagerInterface
    {
        return $this->_doctrine_service_get('EntityManagerInterface');
    }

    protected function closeDoctrine(): void
    {
        $this->getDoctrineEntityManager()?->close();
        $this->_doctrine_service_set('EntityManagerInterface', false);
        $this->_doctrine_service_set('DocumentManager', false);
    }

    protected function getDoctrineObjectManager(): ObjectManager|null
    {
        $manager = $this->_doctrine_service_get('DocumentManager');

        if (false !== $manager) {
            if (!$manager instanceof ObjectManager) {
                throw new \RuntimeException(sprinqtf("getDoctrineObjectManager requires a DocumentManager but %s instance given.", $manager::class));
            }
            
            return $manager;
        }
    }
}
