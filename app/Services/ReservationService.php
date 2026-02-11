<?php

namespace App\Services;

use App\Models\Resource;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Service;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;

class ReservationService
{
    /**
     * Verifica se há disponibilidade para o recurso no intervalo.
     */
    public function isAvailable(Resource $resource, Carbon $startAt, Carbon $endAt, ?int $ignoreReservationId = null): bool
    {
        // TODO: implementar lógica de conflito
    }

    /**
     * Calcula os slots disponíveis para um recurso em um intervalo de datas.
     *
     * @return Collection<array{start_at: Carbon, end_at: Carbon}>
     */
    public function getAvailability(Resource $resource, Carbon $from, Carbon $to): Collection
    {
        // TODO: implementar cálculo de disponibilidade baseado em time_slots + reservas existentes
    }

    /**
     * Cria uma reserva, validando disponibilidade e regras de negócio.
     */
    public function createReservation(
        User $user,
        Resource $resource,
        Carbon $startAt,
        Carbon $endAt,
        ?Service $service = null,
        ?string $notes = null
    ): Reservation {
        // TODO
    }

    /**
     * Atualiza (reagenda) uma reserva existente.
     */
    public function rescheduleReservation(
        Reservation $reservation,
        Carbon $newStartAt,
        Carbon $newEndAt
    ): Reservation {
        // TODO
    }

    /**
     * Cancela uma reserva, definindo cancelled_at e status.
     */
    public function cancelReservation(Reservation $reservation): Reservation
    {
        // TODO
    }
}
