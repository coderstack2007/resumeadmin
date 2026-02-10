<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ResumesController extends Controller
{
    /**
     * Отображение списка резюме
     */
    public function index(Request $request)
    {
        try {
            // Получаем все резюме с JOIN таблицами
            $resumes = DB::table('resumes as r')
                ->select([
                    'r.id',
                    'r.chat_id',
                    'r.name',
                    'r.age',
                    'r.phone',
                    'r.photo_filename',
                    'r.region_id',
                    'reg.name_ru as region_name_ru',
                    'reg.name_uz as region_name_uz',
                    'r.city_id',
                    'c.name_ru as city_name_ru',
                    'c.name_uz as city_name_uz',
                    'r.job_id',
                    'j.name_ru as job_name_ru',
                    'j.name_uz as job_name_uz',
                    'r.language',
                    'r.created_at',
                    'r.updated_at'
                ])
                ->join('regions as reg', 'r.region_id', '=', 'reg.id')
                ->join('cities as c', 'r.city_id', '=', 'c.id')
                ->join('jobs as j', 'r.job_id', '=', 'j.id')
                ->orderBy('r.created_at', 'desc')
                ->paginate(12); // Используем встроенную пагинацию Laravel
            
            // Получаем статистику
            $stats = $this->getStatistics();
            
            return view('resumes.index', [
                'resumes' => $resumes,
                'stats' => $stats,
                'message' => session('message'),
                'messageType' => session('messageType')
            ]);
            
        } catch (\Exception $e) {
            return redirect()->route('resumes.index')
                ->with('message', 'Ошибка подключения к базе данных: ' . $e->getMessage())
                ->with('messageType', 'error');
        }
    }
    
    /**
     * Отображение детальной информации о резюме
     */
    public function show($id)
    {
        try {
            $resume = DB::table('resumes as r')
                ->select([
                    'r.id',
                    'r.chat_id',
                    'r.name',
                    'r.age',
                    'r.phone',
                    'r.photo_filename',
                    'r.region_id',
                    'reg.name_ru as region_name_ru',
                    'reg.name_uz as region_name_uz',
                    'r.city_id',
                    'c.name_ru as city_name_ru',
                    'c.name_uz as city_name_uz',
                    'r.job_id',
                    'j.name_ru as job_name_ru',
                    'j.name_uz as job_name_uz',
                    'r.language',
                    'r.created_at',
                    'r.updated_at'
                ])
                ->join('regions as reg', 'r.region_id', '=', 'reg.id')
                ->join('cities as c', 'r.city_id', '=', 'c.id')
                ->join('jobs as j', 'r.job_id', '=', 'j.id')
                ->where('r.id', $id)
                ->first();
            
            if (!$resume) {
                return redirect()->route('resumes.index')
                    ->with('message', 'Резюме не найдено!')
                    ->with('messageType', 'error');
            }
            
            return view('resumes.show', [
                'resume' => $resume
            ]);
            
        } catch (\Exception $e) {
            return redirect()->route('resumes.index')
                ->with('message', 'Ошибка при получении данных: ' . $e->getMessage())
                ->with('messageType', 'error');
        }
    }
    
    /**
     * Удаление резюме
     */
    public function destroy($id)
    {
        try {
            // Получаем резюме для удаления фото
            $resume = DB::table('resumes')
                ->where('id', $id)
                ->first();
            
            if (!$resume) {
                return redirect()->route('resumes.index')
                    ->with('message', 'Резюме не найдено!')
                    ->with('messageType', 'error');
            }
            
            // Удаляем фото если оно существует
            if ($resume->photo_filename) {
                $photoPath = public_path('storage/images/' . $resume->photo_filename);
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
            }
            
            // Удаляем резюме из базы
            $deleted = DB::table('resumes')
                ->where('id', $id)
                ->delete();
            
            if ($deleted) {
                return redirect()->route('resumes.index')
                    ->with('message', 'Резюме успешно удалено!')
                    ->with('messageType', 'success');
            } else {
                return redirect()->route('resumes.index')
                    ->with('message', 'Ошибка при удалении резюме!')
                    ->with('messageType', 'error');
            }
            
        } catch (\Exception $e) {
            return redirect()->route('resumes.index')
                ->with('message', 'Ошибка при удалении: ' . $e->getMessage())
                ->with('messageType', 'error');
        }
    }
    
    /**
     * Поиск резюме
     */
    public function search(Request $request)
    {
        $query = DB::table('resumes as r')
            ->select([
                'r.id',
                'r.chat_id',
                'r.name',
                'r.age',
                'r.phone',
                'r.photo_filename',
                'r.region_id',
                'reg.name_ru as region_name_ru',
                'reg.name_uz as region_name_uz',
                'r.city_id',
                'c.name_ru as city_name_ru',
                'c.name_uz as city_name_uz',
                'r.job_id',
                'j.name_ru as job_name_ru',
                'j.name_uz as job_name_uz',
                'r.language',
                'r.created_at'
            ])
            ->join('regions as reg', 'r.region_id', '=', 'reg.id')
            ->join('cities as c', 'r.city_id', '=', 'c.id')
            ->join('jobs as j', 'r.job_id', '=', 'j.id');
        
        // Фильтр по имени
        if ($request->has('name') && $request->name != '') {
            $query->where('r.name', 'like', '%' . $request->name . '%');
        }
        
        // Фильтр по профессии
        if ($request->has('job_id') && $request->job_id != '') {
            $query->where('r.job_id', $request->job_id);
        }
        
        // Фильтр по региону
        if ($request->has('region_id') && $request->region_id != '') {
            $query->where('r.region_id', $request->region_id);
        }
        
        // Фильтр по городу
        if ($request->has('city_id') && $request->city_id != '') {
            $query->where('r.city_id', $request->city_id);
        }
        
        // Фильтр по языку
        if ($request->has('language') && $request->language != '') {
            $query->where('r.language', $request->language);
        }
        
        $resumes = $query->orderBy('r.created_at', 'desc')->paginate(12);
        
        // Получаем справочники для фильтров
        $jobs = DB::table('jobs')->orderBy('name_ru')->get();
        $regions = DB::table('regions')->orderBy('name_ru')->get();
        $cities = $request->has('region_id') 
            ? DB::table('cities')->where('region_id', $request->region_id)->orderBy('name_ru')->get()
            : collect();
        
        $stats = $this->getStatistics();
        
        return view('resumes.search', [
            'resumes' => $resumes,
            'jobs' => $jobs,
            'regions' => $regions,
            'cities' => $cities,
            'stats' => $stats,
            'filters' => $request->all()
        ]);
    }
    
    /**
     * Получение статистики
     */
    private function getStatistics()
    {
        try {
            $stats = [];
            
            // Общее количество
            $stats['total'] = DB::table('resumes')->count();
            
            // По языкам
            $stats['by_language'] = DB::table('resumes')
                ->select('language', DB::raw('COUNT(*) as count'))
                ->groupBy('language')
                ->orderBy('count', 'desc')
                ->get();
            
            // По профессиям (топ 10)
            $stats['by_job'] = DB::table('resumes as r')
                ->select('j.name_ru as job_name', DB::raw('COUNT(*) as count'))
                ->join('jobs as j', 'r.job_id', '=', 'j.id')
                ->groupBy('r.job_id', 'j.name_ru')
                ->orderBy('count', 'desc')
                ->limit(10)
                ->get();
            
            // По регионам (топ 5)
            $stats['by_region'] = DB::table('resumes as r')
                ->select('reg.name_ru as region_name', DB::raw('COUNT(*) as count'))
                ->join('regions as reg', 'r.region_id', '=', 'reg.id')
                ->groupBy('r.region_id', 'reg.name_ru')
                ->orderBy('count', 'desc')
                ->limit(5)
                ->get();
            
            // По городам (топ 5)
            $stats['by_city'] = DB::table('resumes as r')
                ->select('c.name_ru as city_name', DB::raw('COUNT(*) as count'))
                ->join('cities as c', 'r.city_id', '=', 'c.id')
                ->groupBy('r.city_id', 'c.name_ru')
                ->orderBy('count', 'desc')
                ->limit(5)
                ->get();
            
            // Последние 5 резюме
            $stats['latest'] = DB::table('resumes as r')
                ->select('r.name', 'j.name_ru as job_name', 'r.created_at')
                ->join('jobs as j', 'r.job_id', '=', 'j.id')
                ->orderBy('r.created_at', 'desc')
                ->limit(5)
                ->get();
            
            return $stats;
            
        } catch (\Exception $e) {
            return [
                'total' => 0,
                'error' => 'Ошибка получения статистики: ' . $e->getMessage()
            ];
        }
    }
    
    /**
     * Экспорт резюме в CSV
     */
    public function export()
    {
        try {
            $resumes = DB::table('resumes as r')
                ->select([
                    'r.id',
                    'r.name',
                    'r.age',
                    'r.phone',
                    'reg.name_ru as region',
                    'c.name_ru as city',
                    'j.name_ru as job',
                    'r.language',
                    'r.created_at'
                ])
                ->join('regions as reg', 'r.region_id', '=', 'reg.id')
                ->join('cities as c', 'r.city_id', '=', 'c.id')
                ->join('jobs as j', 'r.job_id', '=', 'j.id')
                ->orderBy('r.created_at', 'desc')
                ->get();
            
            $filename = 'resumes_export_' . date('Y-m-d_H-i-s') . '.csv';
            
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];
            
            $callback = function() use ($resumes) {
                $file = fopen('php://output', 'w');
                
                // Заголовки CSV
                fputcsv($file, [
                    'ID', 'Имя', 'Возраст', 'Телефон', 'Регион', 
                    'Город', 'Профессия', 'Язык', 'Дата создания'
                ]);
                
                // Данные
                foreach ($resumes as $resume) {
                    fputcsv($file, [
                        $resume->id,
                        $resume->name,
                        $resume->age,
                        $resume->phone,
                        $resume->region,
                        $resume->city,
                        $resume->job,
                        $resume->language,
                        $resume->created_at
                    ]);
                }
                
                fclose($file);
            };
            
            return response()->stream($callback, 200, $headers);
            
        } catch (\Exception $e) {
            return redirect()->route('resumes.index')
                ->with('message', 'Ошибка при экспорте: ' . $e->getMessage())
                ->with('messageType', 'error');
        }
    }
}