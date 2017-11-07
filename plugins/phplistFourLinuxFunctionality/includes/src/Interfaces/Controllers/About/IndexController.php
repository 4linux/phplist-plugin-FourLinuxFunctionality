<?php

namespace phplist\FourLinux\Functionality\Interfaces\Controllers\About;

use phplist\FourLinux\Functionality\Interfaces\Shared\AbstractController;

/**
 * Class IndexController
 *
 * @package phplist\FourLinux\Functionality\Interfaces\Controllers\About
 */
class IndexController extends AbstractController
{
    public function __invoke()
    {
        /** @var \phplistCaixaFunctionality $plugin */
        $plugin = $GLOBALS['plugins'][$_GET['pi']];

        echo $this->render('about/index', [
            'pluginName' => $plugin->name(),
            'pluginDescription' => $plugin->description,
            'pluginVersion' => $plugin->getVersion(),
        ]);
    }
}
