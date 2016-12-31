<?php
/*
 * This file is part of the Magallanes package.
 *
 * (c) Andrés Montañez <andres@andresmontanez.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mage\Task\BuiltIn\Deploy\Release;

use Symfony\Component\Process\Process;
use Mage\Task\AbstractTask;

/**
 * Release Task - Create the Release Directory
 *
 * @author Andrés Montañez <andresmontanez@gmail.com>
 */
class PrepareTask extends AbstractTask
{
    public function getName()
    {
        return 'deploy/release/prepare';
    }

    public function getDescription()
    {
        return '[Release] Preparing Release';
    }

    public function execute()
    {
        $hostPath = rtrim($this->runtime->getEnvironmentConfig('host_path'), '/');

        $cmdMakeDir = sprintf('mkdir -p %s/releases/%s', $hostPath, $this->runtime->getReleaseId());

        /** @var Process $process */
        $process = $this->runtime->runRemoteCommand($cmdMakeDir, false);
        return $process->isSuccessful();
    }
}
