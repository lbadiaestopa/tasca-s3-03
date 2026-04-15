<?php

enum TaskStatus: string
{
    case PENDING = 'pending';
    case PROGRESS = 'in-progress';
    case COMPLETED = 'completed';
}