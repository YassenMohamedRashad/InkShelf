<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\CategoryBook;
use App\Models\Category_book;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CategoryBookResource\Pages;
use App\Filament\Resources\CategoryBookResource\RelationManagers;

class CategoryBookResource extends Resource
{
    protected static ?string $model = Category_book::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make("book_id")->relationship(name: "book", titleAttribute: "id")->required()->native(false)->searchable()->preload(),
                Select::make("category_id")->relationship(name: "category", titleAttribute: "name")->required()->native(false)->searchable()->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->searchable(),
                TextColumn::make('book.title')->extraAttributes(['style' => 'max-width: 200px; overflow:hidden'])->searchable(),
                TextColumn::make('category.name')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCategoryBooks::route('/'),
            'create' => Pages\CreateCategoryBook::route('/create'),
            'view' => Pages\ViewCategoryBook::route('/{record}'),
            'edit' => Pages\EditCategoryBook::route('/{record}/edit'),
        ];
    }
}
