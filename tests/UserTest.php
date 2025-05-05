<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use PDO;

class UserTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        // Configuration de la base de données OVH
        $this->pdo = new PDO(
            'mysql:host=nausicnadmin.mysql.db;dbname=nausicnadmin',
            'nausicnadmin',
            'Admin0vh',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }

    public function testUserLogin()
    {
        // Test avec un utilisateur existant
        $email = 'admin@admin.fr'; // Utilisez un email qui existe dans votre base
        $password = 'mdp'; // Utilisez le mot de passe correspondant

        // Test de la connexion
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifications
        $this->assertNotFalse($user, "L'utilisateur devrait exister");
        $this->assertEquals($email, $user['email'], "L'email devrait correspondre");
        $this->assertTrue(password_verify($password, $user['password']), "Le mot de passe devrait être valide");
    }

    public function testInvalidLogin()
    {
        // Test avec des identifiants invalides
        $email = 'nonexistent@example.com';
        $password = 'wrongpassword';

        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifications
        $this->assertFalse($user, "L'utilisateur ne devrait pas exister");
    }

    public function testUpdateUserRole()
    {
        // Préparation des données de test
        $userId = 1;
        $newRole = 'admin';

        // Exécution de la mise à jour
        $stmt = $this->pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
        $result = $stmt->execute([$newRole, $userId]);

        // Vérification que la mise à jour a réussi
        $this->assertTrue($result);

        // Vérification que le rôle a bien été mis à jour
        $stmt = $this->pdo->prepare("SELECT role FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertEquals($newRole, $user['role']);
    }

    public function testDeleteUser()
    {
        // Préparation des données de test
        $userId = 2; // Un utilisateur qui n'est pas l'admin actuel

        // Exécution de la suppression
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        $result = $stmt->execute([$userId]);

        // Vérification que la suppression a réussi
        $this->assertTrue($result);

        // Vérification que l'utilisateur n'existe plus
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $count = $stmt->fetchColumn();

        $this->assertEquals(0, $count);
    }
} 