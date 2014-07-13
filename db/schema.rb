# encoding: UTF-8
# This file is auto-generated from the current state of the database. Instead
# of editing this file, please use the migrations feature of Active Record to
# incrementally modify your database, and then regenerate this schema definition.
#
# Note that this schema.rb definition is the authoritative source for your
# database schema. If you need to create the application database on another
# system, you should be using db:schema:load, not running all the migrations
# from scratch. The latter is a flawed and unsustainable approach (the more migrations
# you'll amass, the slower it'll run and the greater likelihood for issues).
#
# It's strongly recommended that you check this file into your version control system.

ActiveRecord::Schema.define(version: 20140713031042) do

  # These are extensions that must be enabled in order to support this database
  enable_extension "plpgsql"

  create_table "asset_details", force: true do |t|
    t.integer  "asset_id"
    t.integer  "component_id"
    t.integer  "current_item_id"
    t.integer  "initial_item_id"
    t.integer  "maintenance_detail_id"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "assets", force: true do |t|
    t.integer  "machine_id"
    t.integer  "contact_id"
    t.string   "code"
    t.text     "description"
    t.boolean  "is_deleted",  default: false
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "compatibilities", force: true do |t|
    t.integer  "item_id"
    t.integer  "component_id"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "components", force: true do |t|
    t.integer  "machine_id"
    t.string   "name"
    t.text     "description"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "compounds", force: true do |t|
    t.string   "compound_sku"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "contacts", force: true do |t|
    t.string   "name"
    t.text     "description"
    t.boolean  "is_customer",      default: false
    t.boolean  "is_supplier",      default: false
    t.text     "address"
    t.text     "shipping_address"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "core_builders", force: true do |t|
    t.string   "used_core_sku"
    t.integer  "used_core_id"
    t.string   "new_core_sku"
    t.integer  "new_core_id"
    t.string   "base_core_sku"
    t.text     "description"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "cores", force: true do |t|
    t.string   "core_sku"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "delivery_order_details", force: true do |t|
    t.integer  "delivery_order_id"
    t.integer  "sales_order_detail_id"
    t.integer  "quantity",              default: 0
    t.boolean  "is_confirmed",          default: false
    t.datetime "confirmed_at"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "delivery_orders", force: true do |t|
    t.integer  "sales_order_id"
    t.text     "description"
    t.datetime "delivery_date"
    t.boolean  "is_confirmed",   default: false
    t.datetime "confirmed_at"
    t.boolean  "is_deleted",     default: false
    t.integer  "warehouse_id"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "item_types", force: true do |t|
    t.string   "name"
    t.text     "description"
    t.boolean  "is_deleted",  default: false
    t.integer  "is_legacy",   default: 0
    t.integer  "legacy_code"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "items", force: true do |t|
    t.string   "sku"
    t.text     "description"
    t.integer  "pending_receival", default: 0
    t.integer  "ready",            default: 0
    t.integer  "pending_delivery", default: 0
    t.boolean  "is_deleted",       default: false
    t.datetime "created_at"
    t.datetime "updated_at"
    t.integer  "item_type_id"
    t.integer  "itemable_id"
    t.string   "itemable_type"
  end

  create_table "machines", force: true do |t|
    t.string   "name"
    t.string   "brand"
    t.text     "description"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "maintenance_details", force: true do |t|
    t.integer  "maintenance_id"
    t.integer  "component_id"
    t.text     "diagnosis"
    t.integer  "diagnosis_case"
    t.text     "solution"
    t.integer  "solution_case"
    t.boolean  "is_replacement_required", default: false
    t.integer  "replacement_item_id"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "maintenances", force: true do |t|
    t.integer  "asset_id"
    t.string   "code"
    t.datetime "complaint_date"
    t.text     "complaint"
    t.integer  "complaint_case"
    t.boolean  "is_confirmed",   default: false
    t.datetime "confirmed_at"
    t.boolean  "is_deleted",     default: false
    t.integer  "warehouse_id"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "purchase_order_details", force: true do |t|
    t.integer  "purchase_order_id"
    t.integer  "item_id"
    t.decimal  "discount",          precision: 5, scale: 2, default: 0.0
    t.decimal  "unit_price",        precision: 9, scale: 2, default: 0.0
    t.integer  "quantity",                                  default: 0
    t.integer  "pending_receival",                          default: 0
    t.boolean  "is_confirmed",                              default: false
    t.datetime "confirmed_at"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "purchase_orders", force: true do |t|
    t.integer  "contact_id"
    t.datetime "purchase_date"
    t.text     "description"
    t.decimal  "total",         precision: 12, scale: 2, default: 0.0
    t.boolean  "is_confirmed",                           default: false
    t.datetime "confirmed_at"
    t.boolean  "is_deleted",                             default: false
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "purchase_receival_details", force: true do |t|
    t.integer  "purchase_receival_id"
    t.integer  "purchase_order_detail_id"
    t.integer  "quantity",                 default: 0
    t.integer  "invoiced_quantity",        default: 0
    t.boolean  "is_confirmed",             default: false
    t.datetime "confirmed_at"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "purchase_receivals", force: true do |t|
    t.integer  "purchase_order_id"
    t.text     "description"
    t.datetime "receival_date"
    t.boolean  "is_confirmed",      default: false
    t.datetime "confirmed_at"
    t.boolean  "is_deleted",        default: false
    t.integer  "warehouse_id"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "roles", force: true do |t|
    t.string   "name",        null: false
    t.string   "title",       null: false
    t.text     "description", null: false
    t.json     "the_role",    null: false
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "roller_builders", force: true do |t|
    t.string   "roller_used_core_sku"
    t.integer  "roller_used_core_id"
    t.string   "roller_new_core_sku"
    t.integer  "roller_new_core_id"
    t.string   "base_roller_sku"
    t.integer  "core_builder_id"
    t.integer  "compound_id"
    t.text     "description"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "roller_identification_details", force: true do |t|
    t.string   "identification_code"
    t.integer  "roller_identification_id"
    t.integer  "core_builder_id"
    t.boolean  "is_new_core",              default: false
    t.text     "description"
    t.boolean  "is_job_scheduled",         default: false
    t.boolean  "is_finished",              default: false
    t.boolean  "is_delivered",             default: false
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "roller_identifications", force: true do |t|
    t.string   "code"
    t.boolean  "is_self_production",  default: false
    t.integer  "contact_id"
    t.integer  "warehouse_id"
    t.datetime "identification_date"
    t.text     "description"
    t.boolean  "is_confirmed",        default: false
    t.datetime "confirmed_at"
    t.boolean  "is_deleted",          default: false
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "roller_warehouse_mutation_details", force: true do |t|
    t.integer  "roller_warehouse_mutation_id"
    t.integer  "roller_identification_detail_id"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "roller_warehouse_mutations", force: true do |t|
    t.string   "code"
    t.integer  "roller_identification_id"
    t.date     "warehouse_mutation_date"
    t.text     "description"
    t.boolean  "is_confirmed",             default: false
    t.datetime "confirmed_at"
    t.boolean  "is_deleted",               default: false
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "roller_work_order_details", force: true do |t|
    t.integer  "roller_work_order_id"
    t.integer  "roller_identification_detail_id"
    t.integer  "roller_builder_id"
    t.string   "code"
    t.datetime "finished_at"
    t.boolean  "is_finished",                     default: false
    t.boolean  "is_rejected",                     default: false
    t.datetime "rejected_at"
    t.text     "reject_description"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "roller_work_orders", force: true do |t|
    t.string   "code"
    t.integer  "roller_identification_id"
    t.datetime "work_order_date"
    t.text     "description"
    t.boolean  "is_confirmed",             default: false
    t.datetime "confirmed_at"
    t.integer  "source_warehouse_id"
    t.integer  "target_warehouse_id"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "rollers", force: true do |t|
    t.string   "roller_sku"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "sales_order_details", force: true do |t|
    t.integer  "sales_order_id"
    t.integer  "item_id"
    t.decimal  "discount",         precision: 5, scale: 2, default: 0.0
    t.decimal  "unit_price",       precision: 9, scale: 2, default: 0.0
    t.integer  "quantity",                                 default: 0
    t.integer  "pending_delivery",                         default: 0
    t.boolean  "is_confirmed",                             default: false
    t.datetime "confirmed_at"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "sales_orders", force: true do |t|
    t.integer  "contact_id"
    t.datetime "sales_date"
    t.text     "description"
    t.decimal  "total",        precision: 12, scale: 2, default: 0.0
    t.boolean  "is_confirmed",                          default: false
    t.datetime "confirmed_at"
    t.boolean  "is_deleted",                            default: false
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "stock_adjustment_details", force: true do |t|
    t.integer  "stock_adjustment_id"
    t.integer  "item_id"
    t.integer  "quantity"
    t.boolean  "is_confirmed",        default: false
    t.datetime "confirmed_at"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "stock_adjustments", force: true do |t|
    t.datetime "adjustment_date"
    t.text     "description"
    t.boolean  "is_deleted",      default: false
    t.boolean  "is_confirmed",    default: false
    t.datetime "confirmed_at"
    t.integer  "warehouse_id"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "stock_mutations", force: true do |t|
    t.integer  "item_id"
    t.integer  "quantity"
    t.integer  "case"
    t.integer  "source_document_detail_id"
    t.string   "source_document_detail"
    t.integer  "item_case"
    t.datetime "mutation_date"
    t.integer  "warehouse_id"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "users", force: true do |t|
    t.string   "email",                  default: "",    null: false
    t.string   "encrypted_password",     default: "",    null: false
    t.string   "reset_password_token"
    t.datetime "reset_password_sent_at"
    t.datetime "remember_created_at"
    t.integer  "sign_in_count",          default: 0,     null: false
    t.datetime "current_sign_in_at"
    t.datetime "last_sign_in_at"
    t.string   "current_sign_in_ip"
    t.string   "last_sign_in_ip"
    t.integer  "role_id"
    t.string   "name"
    t.string   "username"
    t.string   "login"
    t.boolean  "is_deleted",             default: false
    t.boolean  "is_main_user",           default: false
    t.string   "authentication_token"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  add_index "users", ["email"], name: "index_users_on_email", unique: true, using: :btree
  add_index "users", ["reset_password_token"], name: "index_users_on_reset_password_token", unique: true, using: :btree

  create_table "warehouse_items", force: true do |t|
    t.integer  "warehouse_id"
    t.integer  "item_id"
    t.integer  "ready",        default: 0
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "warehouse_mutation_details", force: true do |t|
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "warehouse_mutations", force: true do |t|
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "warehouses", force: true do |t|
    t.string   "name"
    t.text     "description"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

end
