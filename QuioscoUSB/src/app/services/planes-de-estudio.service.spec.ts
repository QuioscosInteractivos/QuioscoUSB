import { TestBed, inject } from '@angular/core/testing';

import { PlanesDeEstudioService } from './planes-de-estudio.service';

describe('PlanesDeEstudioService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [PlanesDeEstudioService]
    });
  });

  it('should be created', inject([PlanesDeEstudioService], (service: PlanesDeEstudioService) => {
    expect(service).toBeTruthy();
  }));
});
