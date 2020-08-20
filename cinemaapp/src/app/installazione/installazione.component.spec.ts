import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { InstallazioneComponent } from './installazione.component';

describe('InstallazioneComponent', () => {
  let component: InstallazioneComponent;
  let fixture: ComponentFixture<InstallazioneComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ InstallazioneComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(InstallazioneComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
