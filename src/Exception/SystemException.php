<?php

declare(strict_types=1);

namespace Sholokhov\BitrixModels\Exception;

use Exception;
use Throwable;

/**
 * Является базовым исключением
 *
 * Все вызываемые исключения являются наследниками данного объекта.
 * Если вы хотите отследить исключение именно данного пакета,
 * то рекомендуется прослушивать именно данное исключение
 */
class SystemException extends Exception
{
    /**
     * Контекст исключения
     *
     * @var array
     */
    private readonly array $context;

    public function __construct(string $message = "", int $code = 200, ?Throwable $previous = null, array $context = [])
    {
        $this->context = $context;
        parent::__construct($message, $code, $previous);
    }

    /**
     * Получение контекста исключение.
     *
     * Не все исключения имеют заполненный контекст.
     * Контекст служит, для получения более подробной информации на сколько это возможно
     *
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }
}