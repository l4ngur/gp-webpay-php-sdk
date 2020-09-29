<?php

namespace AdamStipak\Webpay;

class PaymentResponse
{

    /** @var array */
    private $params = [];

    /** @var string */
    private $digest;

    /** @var string */
    private $digest1;

    /**
     * PaymentResponse constructor.
     * @param array $query
     */
    public function __construct(array $query)
    {
        foreach ($query as $id => $value) {
            switch ($id) {
                case 'DIGEST':
                {
                    $this->digest = $value;
                    break;
                }
                case 'DIGEST1':
                {
                    $this->digest1 = $value;
                    break;
                }
                case 'PRCODE':
                case 'SRCODE':
                {
                    $this->params[$id] = (int) $value;
                    break;
                }
                default:
                {
                    $this->params[$id] = $value;
                }
            }
        }
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @return mixed
     */
    public function getDigest(): string
    {
        return $this->digest;
    }

    /**
     * @return bool
     */
    public function hasError(): bool
    {
        return $this->params['PRCODE'] !== 0;
    }

    /**
     * @return string
     */
    public function getDigest1(): string
    {
        return $this->digest1;
    }
}
