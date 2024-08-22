<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\Module;
use App\Models\User;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')->label('Name')
                            ->required(),
                        TextInput::make('email')->email()->label('Email')
                            ->unique(table: User::class, ignoreRecord: true)
                            ->required(),

                        Select::make('roles')
                            ->label('Role')
                            ->relationship(name: 'roles', titleAttribute: 'name')
                            ->getOptionLabelFromRecordUsing(function (Role $record) {
                                return ucwords(str_replace('_', ' ', $record->name));
                            })
                            ->required(),

                        Select::make('modules')
                            ->multiple()
                            ->relationship(name: 'modules', titleAttribute: 'name')
                            ->options(Module::all()->pluck('name', 'id'))
                            ->visibleOn('edit'),

                        TextInput::make('password')->default(function () {
                            return Str::password(15, true, true, true);
                        })
                            ->label('Password')
                            ->required()
                            ->minLength(10)
                            ->visibleOn('create')
                            ->suffixAction(
                                Action::make('generate_password')
                                    ->label('Generate')
                                    ->icon('heroicon-o-arrow-path')
                                    ->tooltip('Generate a random password')
                                    ->action(function (Set $set, $state) {
                                        $set('password', Str::password(15, true, true, true));
                                    })
                            )
                            ->rules(
                                [
                                    RulesPassword::min(10)
                                        ->letters()
                                        ->numbers()
                                        ->symbols(),
                                ]
                            ),

                        Toggle::make('update_password')
                            ->live()
                            ->visibleOn('edit'),

                        TextInput::make('new_password')->default(function () {
                            return Str::password(15, true, true, true);
                        })
                            ->label('New Password')
                            ->required()
                            ->minLength(10)
                            ->suffixAction(
                                Action::make('generate_password')
                                    ->label('Generate')
                                    ->icon('heroicon-o-arrow-path')
                                    ->tooltip('Generate a random password')
                                    ->action(function (Set $set, $state) {
                                        $set('new_password', Str::password(15, true, true, true));
                                    })
                            )
                            ->hidden(fn (Get $get) => $get('update_password') == false)
                            ->rules(
                                [
                                    RulesPassword::min(10)
                                        ->letters()
                                        ->numbers()
                                        ->symbols(),
                                ]
                            ),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->formatStateUsing(fn (string $state): string => __(ucwords($state)))
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
