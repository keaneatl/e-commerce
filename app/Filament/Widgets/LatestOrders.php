<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Actions\Action;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    protected int|string|array $columnSpan = "full";
    protected static ?int $sort = 2;
    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort("created_at", "desc")
            ->columns([
                TextColumn::make('id')
                    ->label("Order ID")
                    ->searchable(),
                TextColumn::make("user.name")
                    ->searchable(),
                TextColumn::make('grand_total')
                    ->money("PHP"),
                TextColumn::make("status")
                    ->sortable()
                    ->searchable()
                    ->badge(),
                TextColumn::make("payment_method")
                    ->sortable()
                    ->searchable(),
                TextColumn::make("payment_status")
                    ->sortable()
                    ->badge()
                    ->searchable(),

                TextColumn::make("created_at")
                    ->label("Ordered Date")
                    ->dateTime(),

            ])
            ->actions([
                \Filament\Tables\Actions\Action::make("View Order")
                    ->url(fn(Order $record): string => OrderResource::getUrl("view", ["record" => $record]))
                    ->icon("heroicon-o-eye")
            ]);
    }
}
