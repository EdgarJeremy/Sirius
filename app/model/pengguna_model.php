<?php


class pengguna_model extends model {

    public function ambil_pengguna() {
        return $this
            ->db
            ->get("pengguna")
            ->result();
    }

}