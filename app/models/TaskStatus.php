<?php

enum TaskStatus: string
{
    case PENDING = 'pending';
    case PROGRESS = 'in-progress';
    case COMPLETED = 'completed';

    public function getColor(): string
    {
        return match ($this) {
            self::PENDING => 'bg-pending text-white',
            self::PROGRESS => 'bg-progress',
            self::COMPLETED => 'bg-primary',
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'PENDING',
            self::PROGRESS => 'IN PROGRESS',
            self::COMPLETED => 'COMPLETED',
        };
    }

    public function getButtonLabel(): string
    {
        return match ($this) {
            self::PENDING => 'START',
            self::PROGRESS => 'COMPLETE',
            self::COMPLETED => 'REOPEN',
        };
    }

    public function getNextStatus(): self
    {
        return match ($this) {
            self::PENDING => self::PROGRESS,
            self::PROGRESS => self::COMPLETED,
            self::COMPLETED => self::PENDING,
        };
    }
}
