## API 實作測驗

### 題目一
PHP 原始碼在 `src` 目錄下。  
FormRequest 定義於 `src/app/Http/Requests/StoreOrderRequest.php`  
OrderCreated Event 位置 `src/app/Events/OrderCreated.php`  
另新增 Listener 位置 `src/app/Listeners/StoreOrder.php`  

SOLID：  
Single Responsibility Principle - Controller 處理請求，業務邏輯則在 Service 各自處理。  
Dependency Inversion Principle - OrderService 使用依賴注入於 Controller 與 Listener。  


使用到的設計模式：  
Controller Pattern - 定義控制器，配合 service 與 model 分層處理請求。  
Observer Pattern - Event 與 Listener 是分離的，允許觸發更多的 Listener 而非一對一。  
Singleton Pattern - 在 AppServiceProvider 註冊 OrderService 使用單例模式。  
Strategy Pattern - FormRequest 即符合此設計模式，可實現不同驗證策略對應不同控制器需要的場景。  
Factory Pattern - Laravel Eloquent 的 Model 即為此模式的實現。  
Adapter Pattern - Laravel Eloquent 可對應到不同的資料庫接口。  
