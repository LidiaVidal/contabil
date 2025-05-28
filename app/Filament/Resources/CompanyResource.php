<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Compania';

    public static function getModelLabel(): string
    {
        return __('Compania');
    }

    public static function getPluralLabel(): string {

        return 'Companias';
        
    }

   

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('address')
                        ->label('Endereço')
                        ->required(),
                Forms\Components\TextInput::make('cnpj')
                ->label('CNPJ')
                ->required()
                ->rules([ 'numeric',
                'digits:14', 
                'unique:companies,cnpj'])
                ->validationMessages([ 
                    'digits' => 'O campo cnpj deve ter exatamente 14 dígitos.', // Mensagem para a regra digits
                    'numeric' => 'Por favor, insira apenas números no campo :attribute.', // Mensagem para a regra numeric (opcional, se quiser sobrescrever a do arquivo de tradução)
                    'unique' => 'Este cnpj já está cadastrado.', // Mensagem para a regra unique (se quiser sobrescrever a do arquivo de tradução)
                ]),
                Forms\Components\TextInput::make('social')
                ->label('Rede social')
                ->required()
                ->maxLength(255)
                ->prefix('@'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('name') // Exemplo: coluna 'name' para o nome da empresa
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('cnpj')
                ->label('CNPJ')
                ->searchable()
                ->sortable(),
                
            Tables\Columns\TextColumn::make('address')
                ->label('Endereço')
                ->searchable()
                ->sortable(),    
            Tables\Columns\TextColumn::make('social')
                ->label('Rede social')
                ->searchable()
                ->sortable()
                ->prefix('@'),
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
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
