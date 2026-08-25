<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use App\RoleEnum;
use Dom\Text;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('name')->label('Name')
                    ->required()
                    ->minLength(3)
                    ->maxLength(255),

                TextInput::make('email')->label('Email')
                    ->email()
                    ->required()
                    ->unique(User::class,'email',ignoreRecord:true)
                    ->maxLength(255),
                    
                TextInput::make('password')->label('Password')
                    ->password()
                    ->confirmed('password_confirmation')
                     ->visibleOn('create')
                    ->required(fn(string $context):bool=> $context==='create')
                    ->minLength(8)
                    ->maxLength(255),
                    TextInput::make('password_confirmation')->label('Password Confirmation')
                    ->password()
                     ->visibleOn('create')
                    ->required(fn(string $context):bool=> $context==='create')
                    ->minLength(8)
                    ->maxLength(255)
                    ->dehydrated(false),
                    
                Select::make('role')->label('Role')->required()->options(RoleEnum::class),
            ]);
    }
}
