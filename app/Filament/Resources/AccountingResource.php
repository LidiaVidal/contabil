<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccountingResource\Pages;
use App\Filament\Resources\AccountingResource\RelationManagers;
use App\Models\Accounting;
use Filament\Forms;
use Filament\Forms\Form;
use Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AccountingResource extends Resource
{
    protected static ?string $model = Accounting::class;

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
                Forms\Components\Select::make('type')
                ->label('Tipo')
                ->required()
                ->options([
                    'receita' => 'Receita',
                    'despesa' => 'Despesa',
                    'ativo' => 'Ativo',
                    'passivo' => 'Passivo',
                ]),
                Forms\Components\TextInput::make('description') // Adiciona o campo de descrição
                ->label('Descrição')
                ->nullable()
                ->columnSpan('full'),
                Forms\Components\TextInput::make('value')
                ->label('Valor')
                ->required() 
                ->prefix('R$')
                ->numeric(),
    
                Forms\Components\DatePicker::make('date')
                ->label('Data')
                ->required(),

                Forms\Components\DatePicker::make('competence_month')
                ->label('Mês Competência')
                ->required()
                ->dehydrateStateUsing(fn (?string $state): ?string => $state ? \Carbon\Carbon::parse($state)->startOfMonth()->toDateString() : null),
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
                Tables\Columns\TextColumn::make('type')
                ->label('Tipo')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('description')
                ->label('Descrição')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('value')
                ->label('Valor')
                ->numeric()
                ->searchable(),
                Tables\Columns\TextColumn::make('date')
                ->label('Data')
                ->date('d-m-y') 
                ->sortable(),
                Tables\Columns\TextColumn::make('competence_month')
                ->label('Mês Competência')
                ->date('Y-m')
                ->sortable(),

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
            'index' => Pages\ListAccountings::route('/'),
            'create' => Pages\CreateAccounting::route('/create'),
            'edit' => Pages\EditAccounting::route('/{record}/edit'),
        ];
    }
}
