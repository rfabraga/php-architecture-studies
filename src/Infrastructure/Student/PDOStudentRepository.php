<?php

namespace Studies\Architecture\Infrastructure\Student;

use Studies\Architecture\Domain\CPF;
use Studies\Architecture\Domain\Student\Student;
use Studies\Architecture\Domain\Student\StudentRepository;
use Studies\Architecture\Domain\Student\StudentNotFoundException;

class PDOStudentRepository implements StudentRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function add(Student $student): void
    {
        $sql = 'INSERT INTO students VALUES (:cpf, :name, :email);';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindvalue('cpf', $student->cpf());
        $stmt->bindvalue('name', $student->name());
        $stmt->bindvalue('email', $student->email());
        $stmt->execute();

        $sql = 'INSERT INTO phones VALUES (:ddd, :number, :student_cpf)';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('student_cpf', $student->cpf());

        foreach ($student->phones() as $phone) {
            $stmt->bindValue('ddd', $phone->ddd());
            $stmt->bindValue('number', $phone->number());
            $stmt->execute();
        }
    }

    public function searchByCpf(CPF $cpf): Student
    {
        $sql = <<<SQL
            SELECT * 
                FROM students 
            LEFT JOIN phones ON phones.student_cpf = students.cpf
            WHERE students.cpf = ?;
SQL;
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, $cpf);
        $stmt->execute();

        $studentData = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if (!empty($studentData)) {
            throw new StudentNotFoundException($cpf);
        }

        return $this->mapStudent($studentData);
    }

    public function searchAll(): array
    {
        $sql = <<<SQL
            SELECT * FROM students
            LEFT JOIN phones ON phones.student_cpf = students.cpf;
SQL;
        $stmt = $this->connection->prepare($sql);
        
        $studentDataList = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $students = [];

        foreach ($studentDataList as $studentData) {
            if (!array_key_exists($studentData['cpf'], $students)) {
                $students[$studentData['cpf']] = Student::withCpfNameAndEmail(
                    $studentData['cpf'],
                    $studentData['name'],
                    $studentData['email']
                );
            }

            $students[$studentData['cpf']]->addPhone(
                $studentData['ddd'],
                $studentData['number']
            );

            return array_values($students);
        }
    }

    public function mapStudent(array $studentData): Student
    {
        $firstEntry = $studentData[0];
        
        $student = Student::withCpfNameAndEmail(
            $firstEntry['cpf'],
            $firstEntry['name'],
            $firstEntry['email'],
        );

        $phones = array_filter(
            $studentData,
            fn ($entry) => $entry['ddd'] !== null && $entry['number'] !== null
        );

        foreach ($phones as $phone) {
            $student->addPhone($phone['ddd'], $phone['number']);
        }

        return $student;
    }
}