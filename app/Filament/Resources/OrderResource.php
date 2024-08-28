<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Order;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OrderResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrderResource\RelationManagers;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make("user_id")->relationship(name: "user", titleAttribute: "name")->required()->native(false)->searchable()->preload(),
                Forms\Components\TextInput::make("order_address")->required(),
                Forms\Components\Select::make("payment_method")->options([
                    'cash' => 'cash',
                ])->required(),
                Forms\Components\Select::make("status")->options([
                    'pending' => 'pending',
                    'processing' => 'processing',
                    'shipped' => 'shipped',
                    'delivered' => 'delivered',
                ])->required(),
                Forms\Components\TextInput::make("description"),
                Forms\Components\TextInput::make("total_amount")->required()->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->searchable(),
                TextColumn::make('user.name')->searchable(),
                TextColumn::make('order_address')->searchable(),
                TextColumn::make('total_amount')->searchable(),
                TextColumn::make('payment_method')->searchable(),
                SelectColumn::make('status')
                    ->options([
                        'pending' => 'pending',
                        'processing' => 'processing',
                        'shipped' => 'shipped',
                        'delivered' => 'delivered',
                        'cancelled' => 'cancelled',
                    ])->extraAttributes(['style' => 'width: 150px;'])->searchable(),
                TextColumn::make('description')->searchable(),

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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
