<?php

namespace App\Character;

use App\ArmorType\ArmorType;
use App\Dice;
use AttackType;

class Character
{
    private const MAX_STAMINA = 100;

    private int $currentStamina = self::MAX_STAMINA;
    private int $currentHealth;
    private string $nickname = '';

    public function __construct(
        private int $maxHealth,
        private int $baseDamage,
        private ArmorType $armorType,
        private AttackType $attackType
    ) {
        $this->currentHealth = $this->maxHealth;
    }

    /**
     * Damage: 1d6 (1 dice of 6)
     */
    public function attack(): int
    {
        $this->currentStamina -= (25 + Dice::roll(20));
        if ($this->currentStamina <= 0) {
            // can't attack this turn
            $this->currentStamina = self::MAX_STAMINA;

            return 0;
        }

        return $this->attackType->performAttack($this->baseDamage);
    }

    public function receiveAttack(int $damage): int
    {
        $armorReduction = $this->armorType->getArmorReduction($damage);
        $damageTaken = max($damage - $armorReduction, 0);
        $this->currentHealth -= $damageTaken;

        return $damageTaken;
    }

    public function getCurrentHealth(): int
    {
        return $this->currentHealth;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
    }

    /**
     * Restore player's health before next fight
     */
    public function rest(): void
    {
        $this->currentHealth = $this->maxHealth;
        $this->currentStamina = self::MAX_STAMINA;
    }
}
