<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-s-user';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image')->directory('images/users/avatars')->image()
                    ->imageEditor()->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])->circleCropper(),
                TextInput::make('name')->required(),
                TextInput::make('email')->required()->email(),
                DatePicker::make('birth_date'),
                Select::make('gender')
                    ->options([
                        'male' => 'male',
                        'female' => 'female',
                    ])->native(false),
                TextInput::make('phone_number'),
                TextInput::make('address'),
                TextInput::make('password')->password()->required(),
                DateTimePicker::make('email_verified_at'),

            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->searchable(),
                ImageColumn::make('image')
                    ->circular()->state(function (User $record) {
                return str_replace('storage/', '', $record->image);
            })->defaultImageUrl(url('/images/other/account_demo.png')),
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('birth_date'),
                TextColumn::make('gender')->searchable(),
                TextColumn::make('phone_number')->searchable(),
                TextColumn::make('address')->searchable(),
                TextColumn::make('password'),
                TextColumn::make('email_verified_at')->dateTime()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
