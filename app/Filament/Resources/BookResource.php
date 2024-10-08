<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Book;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BookResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BookResource\RelationManagers;
use Filament\Tables\Actions\Action;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;
    protected static ?string $navigationIcon = 'heroicon-s-book-open';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('cover')->directory('images/books/covers')->image()
                    ->imageEditor()->imageEditorAspectRatios([
                        '1:1',
                    ]),
                TextInput::make('identifier'),
                TextInput::make('title')->required(),
                TextInput::make('price')->numeric()->required(),
                TextInput::make('stock')->numeric()->required(),
                TextInput::make('publishedDate'),
                TextInput::make('webReaderLink'),
                TextInput::make('pdf'),
                TextInput::make('rate')->numeric(),
                TextInput::make('no_rates')->numeric(),
                TextInput::make('audio'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('id')->searchable(),
                ImageColumn::make('cover')->state(function (Book $record) {
                    return str_replace('storage/', '', $record->cover);
                }),
                TextColumn::make('identifier')->searchable(),
                TextColumn::make('title')->searchable(),
                TextColumn::make('price')->searchable(),
                TextColumn::make('stock')->searchable(),
                TextColumn::make('publishedDate')->searchable(),
                TextColumn::make('webReaderLink')->searchable(),
                TextColumn::make('pdf'),
                TextColumn::make('rate'),
                TextColumn::make('no_rates'),
                TextColumn::make('audio'),
                TextColumn::make('email_verified_at')->dateTime()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Action::make('delete')
                    ->label('delete')
                    ->icon('heroicon-s-trash')
                    ->requiresConfirmation()
                    ->action(function (Book $record) {
                        $record->delete();
                    })
                    ->color('danger'),
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
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'view' => Pages\ViewBook::route('/{record}'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
