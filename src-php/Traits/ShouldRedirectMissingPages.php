<?php

namespace Dewsign\NovaToolRedirects\Traits;

trait ShouldRedirectMissingPages
{
    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        if ($resolved = $this->where($this->getRouteKeyName(), $value)->first()) {
            return $resolved;
        }

        if ($redirectResponse = app(\Spatie\MissingPageRedirector\MissingPageRouter::class)->getRedirectFor(request())) {
            abort($redirectResponse);
        }

        return abort(404);
    }
}
