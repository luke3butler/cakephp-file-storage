<?php
declare(strict_types=1);
/**
 * @author Florian Krämer
 * @copyright 2012 - 2017 Florian Krämer
 * @license MIT
 */
namespace Burzum\FileStorage\Storage\PathBuilder;

/**
 * Includes bugs and workarounds that could not be removed without backward
 * compatibility breaking changes. Use this path builder for projects that you
 * migrated from the Cake2 version to Cake3.
 *
 * DON'T use it if you're not coming from an old version!
 */
class LegacyPathBuilder extends BasePathBuilder
{
    /**
     * @var array
     * Overriding the defaults to get the matching legacy config.
     *
     * @inheritDoc
     */
    protected $_defaultConfig = [
        'pathPrefix' => 'files',
        'modelFolder' => 'files',
        'preserveFilename' => false,
        'idFolder' => true,
        'randomPath' => 'crc32',
    ];

    /**
     * @inheritDoc
     */
    public function randomPath(string $string, int $level = 3, string $method = 'sha1'): string
    {
        $string = str_replace('-', '', $string);

        return parent::randomPath($string, $level, $method);
    }
}
