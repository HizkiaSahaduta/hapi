<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class HapiMemberExport implements FromView
{
    public function __construct(string $qTipeAnggota, string $qStatus, string $qTrainee, string $qProv, string $qKota, string $qMemberID, string $qNama, string $qStartDate, string $qEndDate) {

        $this->qTipeAnggota = $qTipeAnggota;
        $this->qStatus = $qStatus;
        $this->qTrainee = $qTrainee;
        $this->qProv = $qProv;
        $this->qKota = $qKota;
        $this->qMemberID = $qMemberID;
        $this->qNama = $qNama;
        $this->qStartDate = $qStartDate;
        $this->qEndDate = $qEndDate;


    }

    public function view(): View {   

        $where = "where 1=1";

        $qTipeAnggota = $this->qTipeAnggota;
        if ($qTipeAnggota != '') {

            $where.= " and st_anggota = '$qTipeAnggota'";
        }

        $qStatus = $this->qStatus;
        if ($qStatus != '') {

            $where.= " and active_flag = '$qStatus'";
        }

        $qTrainee = $this->qTrainee;
        if ($qTrainee) {

            if ($qTrainee == 'Pelatihan dan Sertifikasi') {

                $where.= "  and st_pelatihan = 'Y' and st_bnsp = 'Y'";
            
            }

            if ($qTrainee == 'Pelatihan') {

                $where.= " and st_pelatihan = 'Y' and st_bnsp = 'N'";

            } 

            if ($qTrainee == 'Sertifikasi') {

                $where.= " and st_pelatihan = 'N' and st_bnsp = 'Y'";
            
            } 

            if ($qTrainee == 'N/A') {

                $where.= " and st_pelatihan = 'N' and st_bnsp = 'N'";
            
            } 


        }

        $qProv = $this->qProv;
        if ($qProv != '') {

            if ($qProv == 'N/A') {

                $where.= " and province1 = ''";

            }

            else {

                $where.= " and province1 like '%$qProv%'";

            }

        }
        
        $qKota = $this->qKota;
        if ($qKota != '') {

            $where.= " and city1 like '%$qKota%'";

        }

        $qMemberID = $this->qMemberID;
        if ($qMemberID != '') {
            
            $where.= " and member_id like '%$qMemberID%'";
        }

        $qNama = $this->qNama;
        if ($qNama != '') {

            $where.= " and member_name like '%$qNama%'";
        }

        $qStartDate = $this->qStartDate;
        $qEndDate = $this->qEndDate;
        if ($qStartDate != '' && $qEndDate != '') {

            $where.= " and dt_created between '$qStartDate' and '$qEndDate'";

        }

        if ($qStartDate != '' && $qEndDate == '') {

            $where.= " and dt_created >= '$qStartDate'";

        }

        if ($qStartDate == '' && $qEndDate != '') {

            $where.= " and dt_created  <= '$qEndDate'";

        }

        $result = DB::select(DB::raw("select 
                FORMAT(dt_created, 'dd.MM.yyyy') as dt_created,
                LTRIM(RTRIM(member_id)) as member_id, 
                LTRIM(RTRIM(st_anggota)) as st_anggota, 
                LTRIM(RTRIM(member_name)) as member_name, 
                LTRIM(RTRIM(sex)) as sex,
                CONCAT(LTRIM(RTRIM(birth_place)), ', ', FORMAT(date_birth, 'dd MMM yyyy')) as dob,
                LTRIM(RTRIM(address)) as address, 
                LTRIM(RTRIM(province)) as province, 
                LTRIM(RTRIM(city)) as city,
                LTRIM(RTRIM(address1)) as address1,
                LTRIM(RTRIM(province1)) as province1, 
                LTRIM(RTRIM(city1)) as city1, 
                LTRIM(RTRIM(phone)) as phone, 
                LTRIM(RTRIM(email)) as email, 
                LTRIM(RTRIM(last_educ)) as last_educ, 
                LTRIM(RTRIM(job)) as job,
                LTRIM(RTRIM(position)) as position,
                LTRIM(RTRIM(position_name)) as position_name,
                case 
                    when active_flag = 'Y' then 'Aktif'
                    else 'NonAktif'
                end as active_flag,
                st_pelatihan, st_bnsp
                from member $where order by 1"));

        return view('exports.HAPIMemberViewExport',['result' => $result]);
        
    }
}


