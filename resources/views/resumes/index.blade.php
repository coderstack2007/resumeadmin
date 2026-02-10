<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ Панель - Резюме</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1600px;
            margin: 0 auto;
        }
        
        .header {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header h1 {
            font-size: 28px;
            color: #667eea;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .logout-btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        
        .logout-btn:hover {
            background: #5568d3;
            transform: translateY(-2px);
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-card i {
            font-size: 40px;
            color: #667eea;
            margin-bottom: 15px;
        }
        
        .stat-card h3 {
            font-size: 32px;
            color: #333;
            margin: 10px 0;
        }
        
        .stat-card p {
            color: #666;
            font-size: 14px;
        }
        
        .message {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            background: white;
        }
        
        .message.success {
            background: #d4edda;
            color: #155724;
            border: 2px solid #c3e6cb;
        }
        
        .message.error {
            background: #f8d7da;
            color: #721c24;
            border: 2px solid #f5c6cb;
        }
        
        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .search-form {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        
        .search-input {
            padding: 12px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            min-width: 250px;
            transition: all 0.3s;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .search-btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .search-btn:hover {
            background: #5568d3;
            transform: translateY(-2px);
        }
        
        .export-btn {
            background: #28a745;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }
        
        .export-btn:hover {
            background: #218838;
            transform: translateY(-2px);
        }
        
        .resume-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }
        
        .resume-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            transition: all 0.3s;
            position: relative;
        }
        
        .resume-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.3);
        }
        
        .photo-section {
            height: 250px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .photo-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .photo-placeholder {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            color: white;
        }
        
        .resume-id-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.95);
            color: #667eea;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }
        
        .info-section {
            padding: 25px;
        }
        
        .name {
            font-size: 22px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }
        
        .job-title {
            text-align: center;
            color: #667eea;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
            padding: 8px;
            background: #f0f3ff;
            border-radius: 8px;
        }
        
        .details {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 20px;
        }
        
        .detail-row {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: #555;
        }
        
        .detail-row i {
            width: 20px;
            color: #667eea;
            font-size: 16px;
        }
        
        .detail-row strong {
            color: #333;
            min-width: 70px;
        }
        
        .language-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .language-badge.ru {
            background: #e3f2fd;
            color: #1976d2;
        }
        
        .language-badge.uz {
            background: #f3e5f5;
            color: #7b1fa2;
        }
        
        .actions {
            display: flex;
            gap: 20px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        
        .btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }
        
        .btn-view {
            background: #17a2b8;
            color: white;
        }
        
        .btn-view:hover {
            background: #138496;
            transform: scale(1.05);
        }
        
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        
        .btn-delete:hover {
            background: #c82333;
            transform: scale(1.05);
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .pagination a,
        .pagination span {
            padding: 12px 20px;
            background: #f8f9fa;
            color: #667eea;
            text-decoration: none;
            border-radius: 8px;
            border: 2px solid transparent;
            transition: all 0.3s;
            font-weight: 600;
        }
        
        .pagination a:hover,
        .pagination .active span {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }
        
        .pagination .disabled span {
            background: #e9ecef;
            color: #6c757d;
            cursor: not-allowed;
        }
        
        .no-resumes {
            background: white;
            border-radius: 20px;
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .no-resumes i {
            font-size: 80px;
            color: #667eea;
            margin-bottom: 20px;
            opacity: 0.5;
        }
        
        .no-resumes h3 {
            color: #333;
            margin-bottom: 10px;
            font-size: 24px;
        }
        
        .no-resumes p {
            color: #666;
            font-size: 16px;
        }
        
        
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>
                <i class="fas fa-users"></i>
                База Резюме
            </h1>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Выход
                </button>
            </form>
        </div>
        
        <div class="stats">
            <div class="stat-card">
                <i class="fas fa-file-alt"></i>
                <h3>{{ $stats['total'] ?? 0 }}</h3>
                <p>Всего резюме</p>
            </div>
            
            @if(isset($stats['by_language']))
                @foreach($stats['by_language'] as $lang)
                <div class="stat-card">
                    <i class="fas fa-{{ $lang->language === 'ru' ? 'flag' : 'globe' }}"></i>
                    <h3>{{ $lang->count }}</h3>
                    <p>{{ $lang->language === 'ru' ? 'Русский' : 'Узбекский' }}</p>
                </div>
                @endforeach
            @endif
            
            <div class="stat-card">
                <i class="fas fa-briefcase"></i>
                <h3>{{ count($stats['by_job'] ?? []) }}</h3>
                <p>Типов вакансий</p>
            </div>
        </div>
        
        @if(session('message'))
        <div class="message {{ session('messageType') }}">
            <i class="fas fa-{{ session('messageType') === 'success' ? 'check-circle' : 'exclamation-circle' }}"></i>
            {{ session('message') }}
        </div>
        @endif
        
        <div class="controls">
           
            
            <a href="{{ route('resumes.export') }}" class="export-btn">
                <i class="fas fa-download"></i>
                Экспорт CSV
            </a>
        </div>
        
        @if($resumes->count() > 0)
        <div class="resume-grid">
            @foreach($resumes as $resume)
            <div class="resume-card">
                <div class="photo-section">
                    <span class="resume-id-badge">#{{ $resume->id }}</span>
                    @if($resume->photo_filename)
                        <img src="{{ asset('storage/images/' . $resume->photo_filename) }}" 
                             alt="{{ $resume->name }}"
                             onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjUwIiBoZWlnaHQ9IjI1MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjNjY3RWVhIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIyNCIgZmlsbD0id2hpdGUiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj5QaG90bzwvdGV4dD48L3N2Zz4='">
                    @else
                        <div class="photo-placeholder">
                            <i class="fas fa-user"></i>
                        </div>
                    @endif
                </div>
                
                <div class="info-section">
                    <span class="language-badge {{ $resume->language }}">
                        {{ $resume->language === 'ru' ? '🇷🇺 Русский' : '🇺🇿 Узбекский' }}
                    </span>
                    
                    <div class="name">{{ $resume->name }}</div>
                    
                    <div class="job-title">
                        <i class="fas fa-briefcase"></i>
                        {{ $resume->job_name_ru }}
                    </div>
                    
                    <div class="details">
                        <div class="detail-row">
                            <i class="fas fa-birthday-cake"></i>
                            <strong>Возраст:</strong>
                            <span>{{ $resume->age }} лет</span>
                        </div>
                        
                        <div class="detail-row">
                            <i class="fas fa-phone"></i>
                            <strong>Телефон:</strong>
                            <span>{{ $resume->phone }}</span>
                        </div>
                        
                        <div class="detail-row">
                            <i class="fas fa-map-marker-alt"></i>
                            <strong>Регион:</strong>
                            <span>{{ $resume->region_name_ru }}</span>
                        </div>
                        
                        <div class="detail-row">
                            <i class="fas fa-city"></i>
                            <strong>Город:</strong>
                            <span>{{ $resume->city_name_ru }}</span>
                        </div>
                        
                        <div class="detail-row">
                            <i class="fas fa-calendar"></i>
                            <strong>Дата:</strong>
                            <span>{{ \Carbon\Carbon::parse($resume->created_at)->format('d.m.Y H:i') }}</span>
                        </div>
                    </div>
                    
                    <div class="actions">
                        
                        <form action="{{ route('resumes.destroy', $resume->id) }}" method="POST" 
                              onsubmit="return confirm('Удалить резюме {{ $resume->name }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">
                                <i class="fas fa-trash"></i>
                                Удалить
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
      
        
        @else
        <div class="no-resumes">
            <i class="fas fa-inbox"></i>
            <h3>Резюме не найдены</h3>
            <p>В базе данных пока нет резюме или они не соответствуют критериям поиска.</p>
        </div>
        @endif
    </div>
    
    <script>
        // Автоматическое скрытие сообщений через 5 секунд
        setTimeout(function() {
            const messages = document.querySelectorAll('.message');
            messages.forEach(function(message) {
                message.style.transition = 'opacity 0.5s';
                message.style.opacity = '0';
                setTimeout(() => message.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>
