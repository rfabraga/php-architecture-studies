<?

namespace Studies\Architecture;

class Phone
{
    private string $ddd;
    private string $number;

    public function __construct(string $ddd, string $number)
    {
        $this->setDDD($ddd);
        $this->setNumber($number);
    }

    public function setDDD(string $ddd): void
    {
        if (preg_match("/(\d{2})/", $ddd) !== 1) {
            throw new \InvalidArgumentException(
                message: "O DDD deve conter dois dígitos."
            );
        }

        $this->ddd = $ddd;
    }

    public function setNumber(string $number): void
    {
        if (preg_match("/(\d{8,9})/", $number) !== 1) {
            throw new \InvalidArgumentException(
                message: "O número deve conter 8 ou 9 dígitos."
            );
        }

        $this->number = $number;
    }

    public function __toString(): string
    {
        return "({$this->ddd}) {$this->number}";
    }
}
