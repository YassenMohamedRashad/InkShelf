<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Book;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\OrderItem;
use App\Models\Order_item;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OrderItemResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrderItemResource\RelationManagers;

class OrderItemResource extends Resource
{
    protected static ?string $model = Order_item::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('order_id')
                    ->relationship(name: 'order', titleAttribute: 'id')
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->preload(),

                Select::make('book_id')
                    ->relationship(name: 'book', titleAttribute: 'id')
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->reactive() // To trigger updates when the book changes
                    ->afterStateUpdated(function ($set, $get, $state) {
                        // Get the selected book's price and stock
                        $book = Book::find($state);
                        $bookPrice = $book?->price ?? 0;
                        $bookStock = $book?->stock ?? 0;

                        // Update the price based on the quantity
                        $quantity = $get('quantity') ?: 1;
                        if ($quantity > $bookStock) {
                            $quantity = $bookStock;
                            $set('quantity', $quantity);
                        }
                        $set('price', $quantity * $bookPrice);
                    }),

                TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($set, $get, $state) {
                        // Get the selected book's price and stock
                        $book = Book::find($get('book_id'));
                        $bookPrice = $book?->price ?? 0;
                        $bookStock = $book?->stock ?? 0;

                        // Ensure quantity does not exceed stock
                        if ($state > $bookStock) {
                            $state = $bookStock;
                            $set('quantity', $state);
                        }

                        // Update the price based on the new quantity
                        $set('price', $state * $bookPrice);
                    }),

                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->disabled()
                    ->dehydrated(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->searchable(),
                TextColumn::make('order.id')->searchable(),
                TextColumn::make('book.id')->searchable(),
                TextColumn::make('quantity')->searchable(),
                TextColumn::make('price')->searchable(),
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
            'index' => Pages\ListOrderItems::route('/'),
            'create' => Pages\CreateOrderItem::route('/create'),
            'view' => Pages\ViewOrderItem::route('/{record}'),
            'edit' => Pages\EditOrderItem::route('/{record}/edit'),
        ];
    }
}
