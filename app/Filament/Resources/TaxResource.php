<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaxResource\Pages;
use App\Filament\Resources\TaxResource\RelationManagers;
use App\Models\Tax;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaxResource extends Resource
{
    protected static ?string $model = Tax::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\Select::make('company_id')
                ->relationship('company', 'name') // Assumindo que existe um relacionamento 'company' no modelo Tax e a tabela companies tem um campo 'name'
                ->required(),
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name') // Assumindo que existe um relacionamento 'user' no modelo Tax e a tabela users tem um campo 'name'
                ->required(),
            Forms\Components\TextInput::make('type_tax')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('tax_name')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('value')
                ->required()
                ->numeric()
                ->prefix('R$'),
                Forms\Components\DatePicker::make('due_date')
                ->required(),
            Forms\Components\DatePicker::make('competence_month')
                ->label('Mês Competência')
                ->required()
                ->dehydrateStateUsing(fn (?string $state): ?string => $state ? \Carbon\Carbon::parse($state)->startOfMonth()->toDateString() : null),
            Forms\Components\Select::make('status')
                ->options([
                    'paid' => 'Pago',
                    'pending' => 'Pendente',
                    'overdue' => 'Atrasado',
                ])
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('company.name') // Mostra o nome da empresa relacionada
                ->sortable(),    
            Tables\Columns\TextColumn::make('user.name') // Mostra o nome do usuário relacionado
                ->sortable(),    
            Tables\Columns\TextColumn::make('type_tax')
                ->searchable(),
            Tables\Columns\TextColumn::make('tax_name')
                ->searchable(),
            Tables\Columns\TextColumn::make('value')
                ->money() 
                ->sortable(),
            Tables\Columns\TextColumn::make('due_date')
                ->date()
                ->sortable(),
            Tables\Columns\TextColumn::make('competence_month')
                ->label('Mês Competência')
                ->date('Y-m')
                ->sortable(),
            Tables\Columns\TextColumn::make('status')
                ->badge() // 
                ->colors([
                    'success' => 'paid',
                    'warning' => 'pending',
                    'danger' => 'overdue',
                ]),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTaxes::route('/'),
            'create' => Pages\CreateTax::route('/create'),
            'edit' => Pages\EditTax::route('/{record}/edit'),
        ];
    }
}
